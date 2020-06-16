<?php


namespace App\Imports;

use App\Models\General;
use App\Models\Taxonomy;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class ExoticTaxonomyImport implements OnEachRow, WithHeadingRow
{


    public function onRow(Row $row)
    {
        ini_set('max_execution_time', 9000);
        ini_set('memory_limit', '2000M');


//
        $row = $row->toArray();
//
        if (!empty($row) && !empty($row['species'])) {
            $taxonomy = $this->storeTaxonomy($row);

            $this->log('Taxonomy:' . $taxonomy->id);
        }


    }

    private function storeTaxonomy($row)
    {
        $row['family_id'] = General::firstOrCreate(['name' => $row['family'], 'type' => 'family'])->id;
        $row['genus_id'] = General::firstOrCreate(['name' => $row['genus'], 'type' => 'genus'])->id;

        // species
        $row['species_id'] = General::firstOrCreate(['name' => $row['species'], 'type' => 'species'])->id;
        if (!empty($row['subspecies'])) {
            $row['subspecies_id'] = General::firstOrCreate(['name' => $row['subspecies'], 'type' => 'sub_species'])->id;
        }
        if (!empty($row['variety'])) {
            $row['variety_id'] = General::firstOrCreate(['name' => $row['variety'], 'type' => 'variety'])->id;
        }
        // taxonomy
        return Taxonomy::firstOrCreate($this->taxonomyData($row));
    }

    private function taxonomyData($row): array
    {
        return [
            'family_id' => $row['family_id'] ?? null,
            'genus_id' => $row['genus_id'] ?? null,
            'species_id' => $row['species_id'] ?? null,
            'subspecies_id' => $row['subspecies_id'] ?? null,
            'variety_id' => $row['variety_id'] ?? null,
            'species_authors' => !empty($row['authors']) ? trim($row['authors']) : null,
            'non_native' => 1
        ];
    }

    private function log(string $message)
    {
        echo "$message\n";
    }


}
