<?php


namespace App\Imports;

use App\Models\SeedGeneral;
use App\Models\SeedWeight;
use Exception;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class SeedWeightImport implements OnEachRow, WithHeadingRow
{
    /**
     * @throws \Throwable
     */
    public function onRow(Row $row)
    {
//        ini_set('max_execution_time', 360000);
//        ini_set('memory_limit', '2000M');
        $row = $row->toArray();
        foreach (array_keys($this->keys()) as $key) {
            throw_if(!in_array($key, array_keys($row)), new Exception("{$key} column is required"));
        }
        throw_if(empty($row['accession_code']) || empty($row['collection_name']), new Exception('accession code and collection name fields are required'));
        if (!empty($row) && !empty($row['accession_code']) && !empty($row['collection_name'])) {
            $row = $this->storeCollection($row);
            $row = collect($row)->filter()->all();
            $model = SeedWeight::create($this->data($row));
            $this->log('SeedWeight:' . $model->id);
        }
    }

    private function keys()
    {
        return [
            "accession_code" => 1,
            "collection_name" => "Active Collection",
            "regeneration_and_evaluation_code" => null,
            "row" => null,
            "column" => null,
            "fruits_relative_humidity" => null,
            "seeds_relative_humidity" => 2,
            "fruits_purity" => null,
            "seeds_purity" => 100,
            "mean_number_of_seeds_per_fruit" => null,
            "range_of_seeds_per_fruit" => null,
            "1000_fruits_weight" => null,
            "1000_seeds_weight" => 0.63,
            "seed_weight" => 16,
            "fruit_weight" => null,
            "date_banked_year" => null,
            "date_banked_month" => null,
            "date_banked_day" => null,
            "other_detailes" => null,
        ];
    }

    private function storeCollection($row)
    {
        $row['collection_id'] = null;
        if (!empty($row['collection_name'])) {
            $row['collection_id'] = SeedGeneral::firstOrCreate(['name' => $row['collection_name'], 'type_id' => 28])->id;
        }

        return $row;
    }

    private function data(array $row)
    {

        $specimen_type_collections = [];
        if ($row['collection_name'] == 'Active Collection') {
            $specimen_type_collections = ['Seed in Active Collection', 'Fruit in Active Collection'];
        }
        if ($row['collection_name'] == 'Base Collection') {
            $specimen_type_collections = ['Seed in Base Collection', 'Fruit in Base Collection'];
        }
        if ($row['collection_name'] == 'Duplicate Collection') {
            $specimen_type_collections = ['Seed in Duplicate Collection', 'Fruit in Duplicate Collection'];
        }
        if ($row['collection_name'] == 'Regenerated in Base Collection') {
            $specimen_type_collections = ['Regenerated Seed in Base Collection', 'Regenerated Fruit in Base Collection'];
        }
        if ($row['collection_name'] == 'Regenerated in Active Collection') {
            $specimen_type_collections = ['Regenerated Seed in Active Collection', 'Regenerated Fruit in Active Collection'];
        }
        if ($row['collection_name'] == 'Regenerated in Duplicate Collection') {
            $specimen_type_collections = ['Regenerated Seed in Duplicate Collection', 'Regenerated Fruit in Duplicate Collection'];
        }
        return [
            'collection_id' => $row['collection_id'],
            'accession_code' => $row['accession_code'],
            'specimen_type_collections' => $specimen_type_collections,
            'regeneration_and_evaluation_code' => $row['regeneration_and_evaluation_code'] ?? null,
            'row' => $row['row'] ?? null,
            'column' => $row['column'] ?? null,
            'fruit_humidity' => !empty($row['fruits_relative_humidity']) ? $row['fruits_relative_humidity'] : null,
            'seed_humidity' => !empty($row['seed_humidity']) ? $row['seed_humidity'] : null,
            'fruit_purity' => !empty($row['fruit_purity']) ? $row['fruit_purity'] : null,
            'seed_purity' => !empty($row['seed_purity']) ? $row['seed_purity'] : null,
            'thousand_fruits_weight' => !empty($row['1000_fruits_weight']) ? $row['1000_fruits_weight'] : null,
            'thousand_seeds_weight' => !empty($row['1000_seeds_weight']) ? $row['1000_seeds_weight'] : null,
            'total_fruit_weight' => !empty($row['fruit_weight']) ? $row['fruit_weight'] : null,
            'total_seed_weight' => !empty($row['seed_weight']) ? $row['seed_weight'] : null,
            'date_banked_year' => !empty($row['date_banked_year']) ? $row['date_banked_year'] : null,
            'date_banked_month' => !empty($row['date_banked_month']) ? $row['date_banked_month'] : null,
            'date_banked_day' => !empty($row['date_banked_day']) ? $row['date_banked_day'] : null,
            'collected_seeds_no' => !empty($row['collected_seeds_no']) ? $row['collected_seeds_no'] : null,
            'number_seeds_per_fruit' => $row['mean_number_of_seeds_per_fruit'] ?? null,
            'range_seeds_per_fruit' => $row['range_of_seeds_per_fruit'] ?? null,
            'description' => $row['other_detailes'] ?? null,

        ];
    }

    private function log(string $message)
    {
        echo "$message\n";
    }

}
