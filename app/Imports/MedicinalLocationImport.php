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
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class MedicinalLocationImport implements OnEachRow, WithHeadingRow
{


    public function onRow(Row $row)
    {
        ini_set('max_execution_time', 9000);
//        ini_set('memory_limit', '2000M');
        $row      = $row->toArray();

        if (!empty($row)) {
            $row = $this->storeTaxonomy($row);

            $row = $this->createLocation($row);
            $row = $this->storeAnalyse($row);
            $row = $this->storeExtract($row);
            $row = $this->storePhenology($row);
            $row = $this->storeTreatment($row);
            $row = $this->storeStudiedSample($row);
            $row = $this->storeAuthor($row);
            $model = MedicinalLocation::create(Arr::only($row, $this->medicinalLocationData()));
            $this->storeMetabolites($row, $model);
            $this->storeConstituent($row, $model->id);
            $this->log('MLocation:' . $model->id);
        }

    }

    private function log(string $message)
    {
        echo "$message\n";
    }

    private function storeTaxonomy($row)
    {
        $row['family_id'] = General::firstOrCreate(['name' => Str::lower($row['family']), 'type' => 'family'])->id;
        $row['genus_id'] = General::firstOrCreate(['name' => Str::lower($row['genus']), 'type' => 'genus'])->id;

        // species
        if (!empty($row['species'])) {
            $row['species_id'] = $this->firstOrCreateSpecies($row);
        }
        // subspecies
        if (!empty($row['subspecies'])) {
            $row['subspecies_id'] = $this->firstOrCreateSubSpecies($row);
        }
        // variety
        if (!empty($row['variety'])) {
            $row['variety_id'] = $this->firstOrCreateVariety($row);
        }
        // taxonomy
        $row['taxonomy_id'] = Taxonomy::firstOrCreate($this->taxonomyData($row))->id;

        return $row;
    }

    private function firstOrCreateSpecies($row)
    {
        $data = $this->speciesData($row);
        $species = General::where($data['species_data'])->get();
        if (count($species) == 0) {
            $specie_id = General::create($data['species_data'])->id;
            if (count($data['species_authors'])) {
                $this->firstOrCreateActorAndActorHub($specie_id, $data['species_authors']);
            }
        } else {
            foreach ($species as $item) {
                $species_authors = collect($item->authors)->pluck('name')->all();
                $diff = collect($data['species_authors'])->diff($species_authors)->all();
                if (count($diff) <= 0) {
                    return $item->id;
                }
            }
            $specie_id = General::create($data['species_data'])->id;
            if (count($data['species_authors'])) {
                $this->firstOrCreateActorAndActorHub($specie_id, $data['species_authors']);
            }

        }

        return $specie_id;
    }

    private function speciesData($row)
    {
        $array = $this->trimPropAuthor($row['species'], 'species');
        $array['species_data'] = [
            'type' => 'species',
            'name' => Str::lower($array['species']) ?? '',
        ];
        return $array;
    }

    /**
     * @param $property
     * @param $model
     * @return array
     */
    private function trimPropAuthor($property, $model)
    {
        $array = [];
        if ($p = strpos($property, ' ')) {
            $array[$model] = trim(substr($property, 0, $p));
            $authors = trim(substr($property, $p, strlen($property)));
            $authors = str_replace(', ', ' & ', $authors);
            $authors = str_replace('-', ' & ', $authors);
            $authors = str_replace(' -', ' & ', $authors);
            $authors = str_replace('- ', ' & ', $authors);
            $array[$model . '_authors'] = collect(array_unique(explode(' & ', $authors)))->filter()->all();
        } else {
            $array[$model] = trim($property);
            $array[$model . '_authors'] = [];
        }

        return $array;


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

    private function firstOrCreateSubSpecies($row)
    {
        $data = $this->subspeciesData($row);
        $subspecies = General::where($data['subspecies_data'])->get();
        if (count($subspecies) == 0) {
            $subspecies_id = General::create($data['subspecies_data'])->id;
            if (count($data['subspecies_authors'])) {
                $this->firstOrCreateActorAndActorHub($subspecies_id, $data['subspecies_authors']);
            }
        } else {
            foreach ($subspecies as $item) {
                $subspecies_authors = collect($item->authors)->pluck('name')->all();
                $diff = collect($data['subspecies_authors'])->diff($subspecies_authors)->all();

                if (count($diff) <= 0) {
                    return $item->id;
                }
            }
            $subspecies_id = General::create($data['subspecies_data'])->id;
            if (count($data['subspecies_authors'])) {
                $this->firstOrCreateActorAndActorHub($subspecies_id, $data['subspecies_authors']);
            }
        }
        return $subspecies_id;
    }

    private function subspeciesData($row)
    {
        $data = $this->trimPropAuthor($row['subspecies'], 'subspecies');
        $data['subspecies_data'] = [
            'type' => 'sub_species',
            'name' => Str::lower($row['subspecies']) ?? '',
        ];

        return $data;
    }

    private function firstOrCreateVariety($row)
    {
        $data = $this->varietyData($row);
        $variety = General::where($data['variety_data'])->get();
        if (count($variety) == 0) {

            $variety_id = General::create($data['variety_data'])->id;
            if (count($data['variety_authors'])) {
                $this->firstOrCreateActorAndActorHub($variety_id, $data['variety_authors']);
            }
        } else {
            foreach ($variety as $item) {
                $variety_authors = collect($item->authors)->pluck('name')->all();
                $diff = collect($data['variety_authors'])->diff($variety_authors)->all();

                if (count($diff) <= 0) {
                    return $item->id;
                }
            }
            $variety_id = General::create($data['variety_data'])->id;
            if (count($data['variety_authors'])) {
                $this->firstOrCreateActorAndActorHub($variety_id, $data['variety_authors']);
            }
        }

        return $variety_id;
    }

    private function varietyData($row)
    {
        $data = $this->trimPropAuthor($row['variety'], 'variety');
        $data['variety_data'] = [
            'type' => 'variety',
            'name' => Str::lower($row['variety']) ?? '',
        ];

        return $data;
    }

    private function taxonomyData($row): array
    {
        return [
            'name' => $row['name'] ?? null,
            'family_id' => $row['family_id'] ?? null,
            'genus_id' => $row['genus_id'] ?? null,
            'species_id' => $row['species_id'] ?? null,
            'subspecies_id' => $row['subspecies_id'] ?? null,
            'variety_id' => $row['variety_id'] ?? null,
        ];
    }

    /**
     * @param $row
     * @return
     */
    private function createLocation($row)
    {
        $row['location_id'] = null;
        if (!empty($row['province'])) {
            $province = Province::where('name_en', Str::ucfirst($row['province']))->first();

            if ($province) {
                $row['province_id'] = $province->id;
                $location_input = $this->locationData($row);
                $row['location_id'] = Location::create($location_input)->id;
            }

        } else {
            $province_value = $row['province'] ?? '';
            $and = !empty($province_value) ? ', ' : '';
            $address_fa_value = $row['address_fa'] ?? '';
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
            'province_id' => $row['province_id'],
            'address_fa' => $row['address_fa'] ?? null,
        ];
    }

    private function storeAnalyse($row)
    {
        $row['analyse_id'] = null;
        if (!empty($row['analyse'])) {
            $row['analyse_id'] = Method::firstOrCreate(['name' => Str::lower($row['analyse']), 'type_id' => 3])->id;
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
        $row['studied_sample'] = 0;
        if (!empty($row['studied_sample'])) {
            $row['studied_sample'] = Str::lower($row['studied_sample']) == 'wild' ? 1 : 2;
        }
        return $row;

    }

    private function storeAuthor($row)
    {
        $journal_id = Journal::firstOrCreate(['title' => Str::lower($row['journal'])])->id;

        $article = Article::create([
            'title' => Str::lower($row['title']),
            'page_no' => $row['page_id'] ?? null,
            'year' => $row['year'] ?? null,
            'journal_id' => $journal_id,
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
     * @return array
     */
    private function medicinalLocationData(): array
    {
        return [
            'location_id',
            'treatment_id',
            'efficiency',
            'studied_sample',
            'article_id',
            'phenology_id',
            'method_distillation_id',
            'method_extraction_id',
            'method_analyse_id',
//            'herbarium_number', deleted by comment dr.sefidkon
            'collecting_year',
            'description',
            'taxonomy_id',
            'code'];
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
        foreach ($constituents as $index=>$item) {
            $strrpos = strrpos($item, '(');
            $substr = substr($item, $strrpos);
            $type = str_replace($substr, '', $item);
            $value = trim($substr, '()');
            $items[$index]['value'] = $value;
            $cons_collection[] = $items[$index]['id'] = ConstituentType::firstOrCreate(['name_en' => trim($type)])->id;
        }

        MedicinalLocationConstituent::where('medicinal_location_id', $medicinal_location_id)
            ->whereNotIn('constituent_type_id', $cons_collection)
            ->delete();

        foreach ($items as $item) {
            MedicinalLocationConstituent::updateOrCreate(
                [
                    'constituent_type_id' => $item['id'],
                    'medicinal_location_id' => $medicinal_location_id
                ],
                [
                    'value' => $item['value']
                ]
            );
        }
    }

}
