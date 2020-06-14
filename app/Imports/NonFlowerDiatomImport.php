<?php


namespace App\Imports;

use App\Models\NonflowerGeneral;
use App\Models\NonflowerTaxonomy;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class NonFlowerDiatomImport implements OnEachRow, WithHeadingRow
{


    public function onRow(Row $row)
    {
        ini_set('max_execution_time', 9000);
//        ini_set('memory_limit', '2000M');


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
        $row['phylum'] = 'Diatom';

        $row['family_id'] = NonflowerGeneral::firstOrCreate(['name' => $row['family'], 'type' => 'family'])->id;
        $row['genus_id'] = NonflowerGeneral::firstOrCreate(['name' => $row['genus'], 'type' => 'genus'])->id;

        // species
        $row['species_id'] = NonflowerGeneral::firstOrCreate(['name' => $row['species'], 'type' => 'species'])->id;

        // taxonomy
        return NonflowerTaxonomy::firstOrCreate($this->taxonomyData($row));
    }

    private function taxonomyData($row): array
    {
        return [
            'phylum' => $row['phylum'] ?? null,
            'name' => $row['name'] ?? null,
            'family_id' => $row['family_id'] ?? null,
            'genus_id' => $row['genus_id'] ?? null,
            'species_id' => $row['species_id'] ?? null,
            'subspecies_id' => $row['subspecies_id'] ?? null,
            'variety_id' => $row['variety_id'] ?? null,
            'species_authors' => !empty($row['authors']) ? trim($row['authors']) : null,
        ];
    }

    private function log(string $message)
    {
        echo "$message\n";
    }


}
