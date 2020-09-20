<?php


namespace App\Imports;

use App\Models\Actor;
use App\Models\ActorHub;
use App\Models\Article;
use App\Models\ConstituentType;
use App\Models\General;
use App\Models\Journal;
use App\Models\Location;
use App\Models\MedicinalLocation;
use App\Models\MedicinalLocationConstituent;
use App\Models\MedicinalPlantType;
use App\Models\Method;
use App\Models\Province;
use App\Models\Taxonomy;
use App\Repositories\MedicinalLocationRepository;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class MedicinalLocationImport implements OnEachRow, WithHeadingRow
{

    public function onRow(Row $row)
    {
        ini_set('max_execution_time', 9000);
//        ini_set('memory_limit', '2000M');
        $row = $row->toArray();
        if (!empty($row) && !empty($row['genus'])) {
            $row = $this->storeTaxonomy($row);
            $row = $this->createLocation($row);
            $row = $this->storeAnalyse($row);
            $row = $this->storeExtract($row);
            $row = $this->storePhenology($row);
            $row = $this->storeTreatment($row);
            $row = $this->storeStudiedSample($row);
            $row = $this->storeAuthor($row);
            $model = MedicinalLocation::create($this->medicinalLocationData($row));
            $this->storeMetabolites($row, $model);
            $this->storeConstituent($row, $model->id);
            $this->log('MLocation:' . $model->id);
        }

    }



    /**
     * @param $row
     * @return
     */
    private function createLocation($row)
    {
        $row['location_id'] = $row['province_id'] = null;
        if (!empty($row['province']) && !empty($row['address_fa'])) {
            $province = Province::where('name_en', Str::ucfirst($row['province']))->first();

            if ($province) {
                $row['province_id'] = $province->id;
            }

            $location_input = $this->locationData($row);
            $row['location_id'] = Location::create($location_input)->id;

        } else {
            $province_value = $row['province'] ?? '';
            $and = !empty($province_value) ? ', ' : '';
            $address_fa_value = $row['address_fa'] ?? '';
            $location_input = $this->locationData($row);
            $row['location_id'] = Location::create($location_input)->id;
            $row['description'] = "Location = {$province_value} {$and} {$address_fa_value}";
        }

        return $row;

    }

    /**
     * @param $input
     * @return array
     */
    private function locationData($row): array
    {
        return [
            'province_id' => $row['province_id'] ?: null,
            'address_en' => $row['address_fa'] ?: null,
        ];
    }

    private function storeAnalyse($row)
    {
        $row['method_analyse_id'] = null;
        if (!empty($row['analyse'])) {
            $row['method_analyse_id'] = Method::firstOrCreate(['name' => Str::lower($row['analyse']), 'type_id' => 3])->id;
        }

        return $row;
    }

    private function storeExtract($row)
    {
        $row['method_extraction_id'] = null;
        if (!empty($row['extract'])) {
            $row['method_extraction_id'] = Method::firstOrCreate(['name' => Str::lower($row['extract']), 'type_id' => 2])->id;
        }
        return $row;

    }

    private function storePhenology($row)
    {
        $row['phenology_id'] = null;
        if (!empty($row['phenology'])) {
            $row['phenology_id'] = MedicinalPlantType::firstOrCreate(['name' => Str::lower($row['phenology']), 'type_id' => 8])->id;
        }
        return $row;

    }

    private function storeTreatment($row)
    {
        $row['treatment_id'] = null;
        if (!empty($row['treatment'])) {
            $row['treatment_id'] = MedicinalPlantType::firstOrCreate(['name' => Str::lower($row['treatment']), 'type_id' => 9])->id;
        }
        return $row;

    }

    private function storeStudiedSample($row)
    {
        if (!empty($row['studied_sample'])) {
            $row['studied_sample'] = Str::lower($row['studied_sample']) == 'wild' ? 1 : 2;
        } else {
            $row['studied_sample'] = 0;
        }
        return $row;

    }

    private function storeAuthor($row)
    {

        if (!empty($row['journal'])) {
            $journal_id = Journal::firstOrCreate(['title' => $row['journal']])->id;
        }
        $article = Article::create([
            'title' => $row['title'] ?? null,
            'page_no' => $row['page_id'] ?? null,
            'year' => $row['year'] ?? null,
            'journal_id' => $journal_id ?? null,
        ]);

        $authors = collect(explode(', ', $row['authors']))->filter()->all();

        if (count($authors)) {
            foreach ($authors as $author) {
                $author = Actor::firstOrCreate(['name' => $author]);
                ActorHub::create([
                    'actor_id' => $author->id,
                    'actorable_id' => $article->id,
                    'actorable_type' => Article::class,
                ]);
            }
        }

        $row['article_id'] = $article->id;
        return $row;

    }

    /**
     * @param $row
     * @return array
     */
    private function medicinalLocationData($row): array
    {
        return [
            'location_id' => $row['location_id'] ?? null,
            'treatment_id' => $row['treatment_id'] ?? null,
            'local_name' => $row['local_name'] ?? null,
            'efficiency' => $row['efficiency'] ? (string)$row['efficiency'] : null,
            'studied_sample' => $row['studied_sample'] ?? 0,
            'article_id' => $row['article_id'] ?? null,
            'phenology_id' => $row['phenology_id'] ?? null,
            'method_distillation_id' => $row['method_distillation_id'] ?? null,
            'method_extraction_id' => $row['method_extraction_id'] ?? null,
            'method_analyse_id' => $row['method_analyse_id'] ?? null,
            'collecting_year' => $row['collecting_year'] ?? null,
            'description' => $row['description'] ?? null,
            'taxonomy_id' => $row['taxonomy_id'] ?? null,
            'code' => $row['code'] ?? null,
        ];
    }

    private function storeMetabolites($row, $medicinal_location)
    {
        $metabolites = [];
        if (!empty($row['metabolite'])) {
            $metabolites = MedicinalPlantType::where(['type_id' => 5, 'name' => Str::lower($row['metabolite'])])->pluck('id')->toArray();

            if (!count($metabolites)) {
                $metabolites[] = MedicinalPlantType::create(['type_id' => 5, 'name' => Str::lower($row['metabolite'])])->id;
            }
            resolve(MedicinalLocationRepository::class)->createHub($medicinal_location->id, 'secondaryMetabolites', $metabolites);
        }
    }

    public function storeConstituent($row, $medicinal_location_id)
    {

        $constituents = $cons_collection = [];

        for ($i = 1; $i <= 10; $i++) {
            $constituents[] = $row["com{$i}"] ?? null;
        }

        $constituents = collect($constituents)->filter()->all();
        $items = [];
        foreach ($constituents as $index => $item) {
            $strrpos = strrpos($item, '(');
            $substr = substr($item, $strrpos);
            $type = str_replace($substr, '', $item);
            $value = trim($substr, '()');
            $items[$index]['value'] = $value;
            $cons_collection[] = $items[$index]['id'] = ConstituentType::firstOrCreate(['name' => trim($type)])->id;
        }

        MedicinalLocationConstituent::where('medicinal_location_id', $medicinal_location_id)
            ->whereNotIn('constituent_type_id', $cons_collection)
            ->delete();

        foreach ($items as $index => $item) {
            MedicinalLocationConstituent::updateOrCreate(
                [
                    'constituent_type_id' => $item['id'],
                    'medicinal_location_id' => $medicinal_location_id,
                    'constituent_id' => $index + 1
                ],
                [
                    'value' => (string)$item['value']
                ]
            );
        }
    }

    private function log(string $message)
    {
        echo "$message\n";
    }

    /**
     * @param $general_id
     * @param $authors
     * @return void
     */
    private function firstOrCreateActorAndActorHub($general_id, $authors)
    {
        if (count($authors)) {
            foreach ($authors as $author) {
                $author = Actor::firstOrCreate(['name' => $author]);
                $this->setActorHub($author, $general_id);
            }
        }
    }

    /**
     * @param $author
     * @param $general
     */
    private function setActorHub($author, $general_id): void
    {
        ActorHub::firstOrCreate([
            'actor_id' => $author->id,
            'actorable_id' => $general_id,
            'actorable_type' => General::class,
        ]);
    }

}
