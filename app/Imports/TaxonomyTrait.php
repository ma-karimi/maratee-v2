<?php


namespace App\Imports;


use App\Models\General;
use App\Models\Taxonomy;
use Illuminate\Support\Str;

trait TaxonomyTrait
{
    private function storeTaxonomy($row)
    {

        $row['family_id'] = General::firstOrCreate(['name' => trim($row['family']), 'type' => 'family'])->id;
        $row['genus_id'] = General::firstOrCreate(['name' => trim($row['genus']), 'type' => 'genus'])->id;

        // species
        if (!empty($row['species'])) {
            $row = $this->firstOrCreateSpecies($row);
        }
        // subspecies
        if (!empty($row['subspecies'])) {
            $row = $this->firstOrCreateSubSpecies($row);
        }
        // variety
        if (!empty($row['variety'])) {
            $row = $this->firstOrCreateVariety($row);
        }
        // taxonomy
        $row['taxonomy_id'] = Taxonomy::firstOrCreate($this->taxonomyData($row))->id;
        return $row;
    }

    private function firstOrCreateSpecies($row)
    {
        $data = $this->speciesData($row);
        $species = General::firstOrCreate($data['species_data']);
        $row['species_id'] = $species->id;
        $row['species_authors'] = $data['species_authors'];

        return $row;
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
            $array[$model . '_authors'] = $authors;
        } else {
            $array[$model] = trim($property);
            $array[$model . '_authors'] = null;
        }

        return $array;


    }

    private function firstOrCreateSubSpecies($row)
    {
        $data = $this->subspeciesData($row);
        $subspecies = General::firstOrCreate($data['subspecies_data']);
        $row['subspecies_id'] = $subspecies->id;
        $row['subspecies_authors'] = $data['subspecies_authors'];

        return $row;
    }

    private function subspeciesData($row)
    {
        $data = $this->trimPropAuthor($row['subspecies'], 'subspecies');
        $data['subspecies_data'] = [
            'type' => 'sub_species',
            'name' => trim($row['subspecies']) ?? '',
        ];

        return $data;
    }

    private function firstOrCreateVariety($row)
    {
        $data = $this->varietyData($row);
        $variety = General::firstOrCreate($data['variety_data']);
        $row['variety_id'] = $variety->id;
        $row['variety_authors'] = $data['variety_authors'];

        return $row;
    }

    private function varietyData($row)
    {
        $data = $this->trimPropAuthor($row['variety'], 'variety');
        $data['variety_data'] = [
            'type' => 'variety',
            'name' => trim($row['variety']) ?? '',
        ];

        return $data;
    }

    private function taxonomyData($row): array
    {
        return [
//            'name' => $row['name'] ?? null,
            'family_id' => $row['family_id'] ?? null,
            'genus_id' => $row['genus_id'] ?? null,
            'species_id' => $row['species_id'] ?? null,
            'subspecies_id' => $row['subspecies_id'] ?? null,
            'variety_id' => $row['variety_id'] ?? null,
            'species_authors' => $row['species_authors'] ?? null,
            'subspecies_authors' => $row['subspecies_authors'] ?? null,
            'variety_authors' => $row['variety_authors'] ?? null,
        ];
    }
}
