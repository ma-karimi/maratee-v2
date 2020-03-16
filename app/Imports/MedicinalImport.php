<?php


namespace App\Imports;

use App\Models\Actor;
use App\Models\ActorHub;
use App\Models\General;
use App\Models\MedicinalLocation;
use App\Models\MedicinalPlant;
use App\Models\Taxonomy;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class MedicinalImport implements OnEachRow, WithHeadingRow
{


    public function onRow(Row $row)
    {
        ini_set('max_execution_time', 9000);
//        ini_set('memory_limit', '2000M');
        $row = $row->toArray();

        if (!empty($row)) {
            $row = $this->storeTaxonomy($row);

            $model = MedicinalPlant::create(Arr::only($row, $this->medicinalData()));

            $this->log('Medicinal:' . $model->id);
        }

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
     * @return array
     */
    private function medicinalData(): array
    {
        return [
            'taxonomy_id',
            'properties_description',
            'compounds'
        ];
    }

    private function log(string $message)
    {
        echo "$message\n";
    }


}
