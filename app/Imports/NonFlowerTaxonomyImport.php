<?php


namespace App\Imports;

use App\Models\Actor;
use App\Models\ActorHub;
use App\Models\NonflowerGeneral;
use App\Models\NonflowerTaxonomy;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class NonFlowerTaxonomyImport implements OnEachRow, WithHeadingRow
{


    public function onRow(Row $row)
    {
        ini_set('max_execution_time', 9000);
//        ini_set('memory_limit', '2000M');
        $row = $row->toArray();

        if (!empty($row)) {
            $taxonomy = $this->storeTaxonomy($row);

            $this->log('Taxonomy:' . $taxonomy->id);
        }

    }

    private function storeTaxonomy($row)
    {
        $row['genus_id'] = NonflowerGeneral::firstOrCreate(['name' => $row['genus'], 'type' => 'genus'])->id;

        // species
        $row['species_id'] = $this->firstOrCreateSpecies($row);

        // taxonomy
        return NonflowerTaxonomy::firstOrCreate($this->taxonomyData($row));
    }

    private function firstOrCreateSpecies($row)
    {
        $data = $this->speciesData($row);
        $species = NonflowerGeneral::where($data['species_data'])->get();
        if (count($species) == 0) {
            $specie_id = NonflowerGeneral::create($data['species_data'])->id;
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
            $specie_id = NonflowerGeneral::create($data['species_data'])->id;
            if (count($data['species_authors'])) {
                $this->firstOrCreateActorAndActorHub($specie_id, $data['species_authors']);
            }

        }

        return $specie_id;
    }

    private function speciesData($row)
    {
        $array = $this->trimPropAuthor($row['authors'], 'species');
        $array['species_data'] = [
            'type' => 'species',
            'name' => $row['species'] ?? '',
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
        $array[$model . '_authors'] = [];

        $authors = trim($property);
        $authors = str_replace(', ', ' & ', $authors);
        $authors = str_replace('-', ' & ', $authors);
        $authors = str_replace(' -', ' & ', $authors);
        $authors = str_replace('- ', ' & ', $authors);
        $array[$model . '_authors'] = collect(array_unique(explode(' & ', $authors)))->filter()->all();

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
            'actorable_type' => NonflowerGeneral::class,
        ]);
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

    private function log(string $message)
    {
        echo "$message\n";
    }


}
