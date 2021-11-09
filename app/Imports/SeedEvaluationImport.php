<?php


namespace App\Imports;

use App\Models\SeedEvaluation;
use App\Models\SeedGeneral;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class SeedEvaluationImport implements OnEachRow, WithHeadingRow
{


    public function onRow(Row $row)
    {
//        ini_set('max_execution_time', 9000);
//        ini_set('memory_limit', '2000M');
        $row = $row->toArray();

        if (!empty($row) && !empty($row['accession_code'])) {

            $row = $this->storeCollection($row);
            $row = collect($row)->filter()->all();
            $model = SeedEvaluation::create($this->data($row));
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

        $row['dormancy_breaking_id'] = null;
        if (!empty($row['dormancy_breaking_id'])) {
            $row['dormancy_breaking_id'] = SeedGeneral::firstOrCreate(['name' => $row['dormancy_breaking_id'], 'type_id' => 23])->id;
        }


        return $row;
    }

    private function data(array $row)
    {
        return [
            'collection_id' => $row['collection_id'],
            'project_id' => $row['project_id'] ?? null,
            'specimen_type_id' => $row['specimen_type_id'] ?? null,
            'regeneration_code' => $row['regeneration_code'] ?? null,
            'number_of_exchanged_seeds' => !empty($row['number_of_exchanged_seeds']) ? "{$row['number_of_exchanged_seeds']}" :  null,
            'light_hr' => !empty($row['light_hr']) ? "{$row['light_hr']}" :  null,
            'light_c' => !empty($row['light_c']) ? "{$row['light_c']}" :  null,
            'dark_hr' => !empty($row['dark_hr']) ? "{$row['dark_hr']}" :  null,
            'dark_c' => !empty($row['dark_c']) ? "{$row['dark_c']}" :  null,
            'started_test' => !empty($row['started_test']) ? "{$row['started_test']}" :  null,
            'started_germination' => !empty($row['started_germination']) ? "{$row['started_germination']}" :  null,
            'repeat' => !empty($row['repeat']) ? "{$row['repeat']}" :  null,
            'planted_seeds' => !empty($row['planted_seeds']) ? "{$row['planted_seeds']}" :  null,
            'dormancy_termination' => !empty($row['dormancy_termination']) ? "{$row['dormancy_termination']}" :  null,
            'germination_period' => !empty($row['germination_period']) ? "{$row['germination_period']}" :  null,
            'fresh_non_germinated' => !empty($row['fresh_non_germinated']) ? "{$row['fresh_non_germinated']}" :  null,
            'rotten_seed' => !empty($row['rotten_seed']) ? "{$row['rotten_seed']}" :  null,
            'abnormal' => !empty($row['abnormal']) ? "{$row['abnormal']}" :  null,
            'germinated_number' => !empty($row['germinated_number']) ? "{$row['germinated_number']}" :  null,
            'seedling_mortality' => !empty($row['seedling_mortality']) ? "{$row['seedling_mortality']}" :  null,
            'mean_fresh_seedling_weight' => !empty($row['mean_fresh_seedling_weight']) ? "{$row['mean_fresh_seedling_weight']}" :  null,
            'mean_dry_seedling_weight' => !empty($row['mean_dry_seedling_weight']) ? "{$row['mean_dry_seedling_weight']}" :  null,
            'dry_matter' => !empty($row['dry_matter']) ? "{$row['dry_matter']}" :  null,
            'dormancy_breaking_id' => !empty($row['dormancy_breaking_id']) ? "{$row['dormancy_breaking_id']}" :  null,
            'describe_dormancy_treatment' => !empty($row['describe_dormancy_treatment']) ? "{$row['describe_dormancy_treatment']}" :  null,
            'description' => !empty($row['description']) ? "{$row['description']}" :  null,
            'min_radical' => !empty($row['min_radical']) ? "{$row['min_radical']}" :  null,
            'max_radical' => !empty($row['max_radical']) ? "{$row['max_radical']}" :  null,
            'min_shoot' => !empty($row['min_shoot']) ? "{$row['min_shoot']}" :  null,
            'max_shoot' => !empty($row['max_shoot']) ? "{$row['max_shoot']}" :  null,
            'min_seed' => !empty($row['min_seed']) ? "{$row['min_seed']}" :  null,
            'max_seed' => !empty($row['max_seed']) ? "{$row['max_seed']}" :  null,
            'min_seed_width' => !empty($row['min_seed_width']) ? "{$row['min_seed_width']}" :  null,
            'max_seed_width' => !empty($row['max_seed_width']) ? "{$row['max_seed_width']}" :  null,
            'project_title' => !empty($row['project_title']) ? "{$row['project_title']}" :  null,
            'research_title' => !empty($row['research_title']) ? "{$row['research_title']}" :  null,
            'project_leader_name' => !empty($row['project_leader_name']) ? "{$row['project_leader_name']}" :  null,
            'research_leader_name' => !empty($row['research_leader_name']) ? "{$row['research_leader_name']}" :  null,
            'project_no' => !empty($row['project_no']) ? "{$row['project_no']}" :  null,
            'research_no' => !empty($row['research_no']) ? "{$row['research_no']}" :  null,
            'accession_code' => !empty($row['accession_code']) ? "{$row['accession_code']}" :  0,
            'germinated_seed_no' => !empty($row['germinated_seed_no']) ? "{$row['germinated_seed_no']}" :  null,
        ];
    }

    private function log(string $message)
    {
        echo "$message\n";
    }

}
