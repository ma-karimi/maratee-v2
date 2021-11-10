<?php


namespace App\Imports;

use App\Models\SeedExchange;
use App\Models\SeedGeneral;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class SeedExchangesImport implements OnEachRow, WithHeadingRow
{


    public function onRow(Row $row)
    {
//        ini_set('max_execution_time', 9000);
//        ini_set('memory_limit', '2000M');
        $row = $row->toArray();

        if (!empty($row) && !empty($row['accession_code'])) {

            $row = $this->storeCollection($row);
            $row = collect($row)->filter()->all();
            $model = SeedExchange::create($this->data($row));
            $this->log('SeedWeight:' . $model->id);
        }

    }

    private function storeCollection($row)
    {
        $row['collection_id'] = null;
        if (!empty($row['collection'])) {
            $row['collection_id'] = SeedGeneral::firstOrCreate(['name' => $row['collection'], 'type_id' => 19])->id;
        }

        $row['specimen_type_id'] = null;
        if (!empty($row['specimen_type_id'])) {
            $row['specimen_type_id'] = SeedGeneral::firstOrCreate(['name' => $row['specimen_type_id'], 'type_id' => 1])->id;
        }

        return $row;
    }

    private function data(array $row)
    {
        return [
            'regeneration_code' => $row['regeneration_code'] ?? null,
            'organization_id' => $row['organization_id'] ?? null,
            'project_id' => $row['project_id'] ?? null,
            'department_name' => $row['department_name'] ?? null,
            'project_title' => $row['project_title'] ?? null,
            'collection_id' => $row['collection_id'] ?? null,
            'research_title' => !empty($row['research_title']) ? "{$row['research_title']}" :  null,
            'project_leader_name' => !empty($row['project_leader_name']) ? "{$row['project_leader_name']}" :  null,
            'research_leader_name' => !empty($row['research_leader_name']) ? "{$row['research_leader_name']}" :  null,
            'project_no' => !empty($row['project_no']) ? "{$row['project_no']}" :  null,
            'research_no' => !empty($row['research_no']) ? "{$row['research_no']}" :  null,
            'specimen_type_id' => !empty($row['specimen_type_id']) ? "{$row['specimen_type_id']}" :  null,
            'weight' => !empty($row['weight']) ? "{$row['weight']}" :  null,
            'delivery_date' => !empty($row['delivery_date']) ? "{$row['delivery_date']}" :  null,
            'recipient_name' => $row['recipient_name'] ?? null,
            'request_no' => $row['request_no'] ?? null,
            'description' => $row['description'] ?? null,
            'accession_code' => $row['accession_code'] ?? 0,

        ];
    }

    private function log(string $message)
    {
        echo "$message\n";
    }

}
