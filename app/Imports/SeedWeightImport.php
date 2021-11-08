<?php


namespace App\Imports;

use App\Models\SeedGeneral;
use App\Models\SeedWeight;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class SeedWeightImport implements OnEachRow, WithHeadingRow
{

    public function onRow(Row $row)
    {
//        ini_set('max_execution_time', 360000);
//        ini_set('memory_limit', '2000M');
        $row = $row->toArray();
        if (!empty($row) && !empty($row['accession_code'])) {
            $row = $this->storeCollection($row);
            $row = collect($row)->filter()->all();
            $model = SeedWeight::create($this->data($row));
            $this->log('SeedWeight:' . $model->id);
        }
    }

    private function storeCollection($row)
    {
        $row['collection_id'] = null;
        if (!empty($row['collection'])) {
            $row['collection_id'] = SeedGeneral::firstOrCreate(['name' => $row['collection'], 'type_id' => 19])->id;
        }

        return $row;
    }

    private function data(array $row)
    {
        return [
            'collection_id' => $row['collection_id'],
            'regeneration_code' => $row['regeneration_code'] ?? null,
            'row' => $row['row'] ?? null,
            'column' => $row['column'] ?? null,
            'fruit_humidity' => !empty($row['fruit_humidity']) ? "{$row['fruit_humidity']}" :  null,
            'seed_humidity' => !empty($row['seed_humidity']) ? "{$row['seed_humidity']}" :  null,
            'fruit_purity' => !empty($row['fruit_purity']) ? "{$row['fruit_purity']}" :  null,
            'seed_purity' => !empty($row['seed_purity']) ? "{$row['seed_purity']}" :  null,
            'thousand_fruits_weight' => !empty($row['thousand_fruits_weight']) ? "{$row['thousand_fruits_weight']}" :  null,
            'thousand_seeds_weight' => !empty($row['thousand_seeds_weight']) ? "{$row['thousand_seeds_weight']}" :  null,
            'total_fruit_weight' => !empty($row['total_fruit_weight']) ? "{$row['total_fruit_weight']}" :  null,
            'total_seed_weight' => !empty($row['total_seed_weight']) ? "{$row['total_seed_weight']}" :  null,
            'banked' => !empty($row['banked']) ? "{$row['banked']}" :  null,
            'collected_seeds_no' => !empty($row['collected_seeds_no']) ? "{$row['collected_seeds_no']}" :  null,
            'number_seeds_per_fruit' => $row['number_seeds_per_fruit'] ?? null,
            'range_seeds_per_fruit' => $row['range_seeds_per_fruit'] ?? null,
            'description' => $row['description'] ?? null,
            'accession_code' => $row['accession_code'] ?? null,

        ];
    }

    private function log(string $message)
    {
        echo "$message\n";
    }

}
