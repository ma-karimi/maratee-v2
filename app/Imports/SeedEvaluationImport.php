<?php


namespace App\Imports;

use App\Models\SeedGeneral;
use App\Models\SeedWeight;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class GerminationsImport implements OnEachRow, WithHeadingRow
{


    public function onRow(Row $row)
    {
        ini_set('max_execution_time', 9000);
//        ini_set('memory_limit', '2000M');
        $row = $row->toArray();

        if (!empty($row) && !empty($row['accession_code'])) {

            $row = $this->storeCollection($row);
            $row = collect($row)->filter()->all();
            $model = Germinatio::create($this->data($row));
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
            'dormancy_breaking_treatments' => $row['dormancy_breaking_treatments'],
            'light_date' => $row['light_date'] ?? null,
            'dark_date' => $row['dark_date'] ?? null,
            'light_temperature' => $row['light_temperature'] ?? null,
            'dark_temperature' => !empty($row['dark_temperature']) ? "{$row['dark_temperature']}" :  null,
            'dormancy_termination' => !empty($row['dormancy_termination']) ? "{$row['dormancy_termination']}" :  null,
            'germination_period' => !empty($row['germination_period']) ? "{$row['germination_period']}" :  null,
            'germination_percentage' => !empty($row['germination_percentage']) ? "{$row['germination_percentage']}" :  null,
            'germination_rate' => !empty($row['germination_rate']) ? "{$row['germination_rate']}" :  null,
            'germination_start' => !empty($row['germination_start']) ? "{$row['germination_start']}" :  null,
            'dormancy_breaking_description' => !empty($row['dormancy_breaking_description']) ? "{$row['dormancy_breaking_description']}" :  null,
        ];
    }

    private function log(string $message)
    {
        echo "$message\n";
    }

}
