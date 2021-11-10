<?php


namespace App\Imports;

use App\Models\SeedGeneral;
use App\Models\SeedMorphology;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class SeedMorphologiesImport implements OnEachRow, WithHeadingRow
{


    public function onRow(Row $row)
    {
//        ini_set('max_execution_time', 9000);
//        ini_set('memory_limit', '2000M');
        $row = $row->toArray();

        if (!empty($row) && !empty($row['accession_code'])) {

            $row = $this->storeCollection($row);
            $row = collect($row)->filter()->all();
            $model = SeedMorphology::create($this->data($row));
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
            'collection_id' => $row['collection_id'] ?? null,
            'specimen_type_id' => $row['specimen_type_id'] ?? null,
            'organization_id' => $row['organization_id'] ?? null,
            'field_id' => $row['field_id'] ?? null,
            'regeneration_code' => $row['regeneration_code'] ?? null,
            'department_name' => !empty($row['department_name']) ? "{$row['department_name']}" :  null,
            'replication_or_block_number' => !empty($row['replication_or_block_number']) ? "{$row['replication_or_block_number']}" :  null,
            'plant_density' => !empty($row['plant_density']) ? "{$row['plant_density']}" :  null,
            'observation_no' => !empty($row['observation_no']) ? "{$row['observation_no']}" :  null,
            'planting_date' => !empty($row['planting_date']) ? "{$row['planting_date']}" :  null,
            'observation_date' => !empty($row['observation_date']) ? "{$row['observation_date']}" :  null,
            'days_to_start_flowering' => !empty($row['days_to_start_flowering']) ? "{$row['days_to_start_flowering']}" :  null,
            'days_to_flowering' => !empty($row['days_to_flowering']) ? "{$row['days_to_flowering']}" :  null,
            'project_leader_name' => !empty($row['project_leader_name']) ? "{$row['project_leader_name']}" :  null,
            'research_leader_name' => !empty($row['research_leader_name']) ? "{$row['research_leader_name']}" :  null,
            'project_no' => !empty($row['project_no']) ? "{$row['project_no']}" :  null,
            'research_no' => !empty($row['research_no']) ? "{$row['research_no']}" :  null,
            'days_to_seed_ripening' => $row['days_to_seed_ripening'] ?? null,
            'accession_code' => $row['accession_code'] ?? 0,
            'project_title' => $row['project_title'] ?? null,
            'research_title' => $row['research_title'] ?? null,

        ];
    }

    private function log(string $message)
    {
        echo "$message\n";
    }

}
