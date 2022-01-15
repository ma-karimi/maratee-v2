<?php


namespace App\Imports;

use App\Models\SeedEvaluation;
use App\Models\SeedGeneral;
use Exception;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class SeedEvaluationImport implements OnEachRow, WithHeadingRow
{


    /**
     * @throws \Throwable
     */
    public function onRow(Row $row)
    {
//        ini_set('max_execution_time', 9000);
//        ini_set('memory_limit', '2000M');
        $row = $row->toArray();
        foreach (array_keys($this->keys()) as $key) {
            throw_if(!in_array($key, array_keys($row)), new Exception("{$key} column is required"));
        }
        throw_if(empty($row['accession_code']) || empty($row['specimen_typecollection_name']), new Exception('Accession code and Specimen type/collection name fields are required'));
        if (!empty($row) && !empty($row['accession_code']) && !empty($row['specimen_typecollection_name'])) {
            $row = $this->storeCollection($row);
            $row = collect($row)->filter()->all();
            $model = SeedEvaluation::create($this->data($row));
            $this->log('SeedEvaluation:' . $model->id);
        }
    }

    private function keys()
    {
        return [
            "accession_code" => null,
            "regeneration_and_evaluation_code" => null,
            "specimen_typecollection_name" => null,
            "name_of_organization" => null,
            "name_of_departmentgroup" => null,
            "city" => null,
            "phone" => null,
            "fax" => null,
            "email_address" => null,
            "project_title" => null,
            "research_title" => null,
            "project_leader_name" => null,
            "research_leader_name" => null,
            "project_no" => null,
            "research_no" => null,
            "research_leader_mobile" => null,
            "co_reasercher_name" => null,
            "number_of_exchanged_seeds" => null,
            "dormancy_breaking_treatments" => null,
            "light_hr" => null,
            "dark_hr" => null,
            "light_c" => null,
            "dark_c" => null,
            "date_started_test_year" => null,
            "date_started_test_month" => null,
            "date_started_test_day" => null,
            "date_started_germination_counting_year" => null,
            "date_started_grmination_counting_month" => null,
            "date_started_grmination_counting_day" => null,
            "repeat" => null,
            "number_of_planted_seeds" => null,
            "dormancy_termination_day" => null,
            "germination_period_day" => null,
            "number_of_fresh_non_germinated_seed" => null,
            "number_of_rotten_seed" => null,
            "number_of_abnormal_seedling" => null,
            "germination" => null,
            "viability" => null,
            "number_of_seedling_mortality" => null,
            "mean_fresh_seedling_weight_g_in_10_seedlings" => null,
            "mean_dry_seedling_weight_g_in_10_seedlings" => null,
            "dry_matter" => null,
            "describe_the_dormancy_breaking_treatment" => null,
            "other_detales" => null,
            "day" => null,
            "germinated_number" => null,
            "radical_length" => null,
            "pedicle_length" => null,
            "seed_lenght" => null,
            "seed_width" => null,
            "seed_image_jpg_up_to_200_kb" => null,

        ];
    }

    private function storeCollection($row)
    {
        $row['collection_id'] = null;
        if (!empty($row['specimen_typecollection_name'])) {
            $row['collection_id'] = SeedGeneral::firstOrCreate(['name' => $row['specimen_typecollection_name'], 'type_id' => 19])->id;
        }


        return $row;
    }

    private function data(array $row)
    {
        $germinationValues = [];
        for ($i = 1; $i = 100; $i++) {
            $d = $row['day_' . $i];
            $g = $row['germinated_number_' . $i];
            if (!empty($d) && !empty($g)) {
                $germinationValues[] = ['day' => $d, 'germinatedNo' => $g];
            }
        }
        $seedlingSizes = [];
        for ($i = 1; $i = 100; $i++) {
            $d = $row['radical_length_' . $i];
            $g = $row['pedicle_length_' . $i];
            if (!empty($d) && !empty($g))
                $seedlingSizes[] = ['radical' => $d, 'pedical' => $g];
        }
        $seedSizes = [];
        for ($i = 1; $i = 100; $i++) {
            $l = $row['seed_lenght_' . $i];
            $w = $row['seed_width_' . $i];
            if (!empty($d) && !empty($g))
                $seedSizes[] = ['length' => $l, 'width' => $w];
        }
//        $radicals = [];
//        for ($i = 1; $i = 100; $i++) {
//            $r = $row['radical_length_' . $i];
//            if (!empty($d) && !empty($g))
//                $radicals[] = ['value' => $r];
//        }
        $traits = [];
        for ($i = 1; $i = 100; $i++) {
            $t = $row['trait_value_' . $i];
            if (!empty($d) && !empty($g))
                $traits[] = ['value' => $t];
        }
        $organization = [
            'name_en' => $row['name_of_organization'] ?? '',
            'city' => $row['city'] ?? '',
            'phone' => $row['phone'] ?? '',
            'fax' => $row['fax'] ?? '',
            'email' => $row['email_address'] ?? '',
            'department_name' => $row['name_of_departmentgroup'] ?? ''
        ];
        return [
            'germination_values' => $germinationValues,
            'seedling_sizes' => $seedlingSizes,
            'seed_sizes' => $seedSizes,
            'traits' => $traits,
            'organization' => $organization,
            'collection_id' => $row['collection_id'] ?? null,
            'regeneration_code' => $row['regeneration_and_evaluation_code'] ?? null,
            'number_of_exchanged_seeds' => !empty($row['number_of_exchanged_seeds']) ? "{$row['number_of_exchanged_seeds']}" : null,
            'light_hr' => !empty($row['light_hr']) ? $row['light_hr'] : null,
            'light_c' => !empty($row['light_c']) ? $row['light_c'] : null,
            'dark_hr' => !empty($row['dark_hr']) ? $row['dark_hr'] : null,
            'dark_c' => !empty($row['dark_c']) ? $row['dark_c'] : null,
            'repeat' => !empty($row['repeat']) ? $row['repeat'] : null,
            'planted_seeds' => !empty($row['number_of_planted_seeds']) ? $row['number_of_planted_seeds'] : null,
            'dormancy_termination' => !empty($row['dormancy_termination_day']) ? $row['dormancy_termination_day'] : null,
            'germination_period' => !empty($row['germination_period_day']) ? $row['germination_period_day'] : null,
            'fresh_non_germinated' => !empty($row['number_of_fresh_non_germinated_seed']) ? $row['number_of_fresh_non_germinated_seed'] : null,
            'rotten_seed' => !empty($row['number_of_rotten_seed']) ? $row['number_of_rotten_seed'] : null,
            'abnormal' => !empty($row['number_of_abnormal_seedling']) ? $row['number_of_abnormal_seedling'] : null,
            'germinated_number' => !empty($row['germinated_number']) ? $row['germinated_number'] : null,
            'seedling_mortality' => !empty($row['number_of_seedling_mortality']) ? $row['number_of_seedling_mortality'] : null,
            'mean_fresh_seedling_weight' => !empty($row['mean_fresh_seedling_weight_g_in_10_seedlings']) ? $row['mean_fresh_seedling_weight_g_in_10_seedlings'] : null,
            'mean_dry_seedling_weight' => !empty($row['mean_dry_seedling_weight_g_in_10_seedlings']) ? $row['mean_dry_seedling_weight_g_in_10_seedlings'] : null,
            'dry_matter' => !empty($row['dry_matter']) ? $row['dry_matter'] : null,
            'dormancy_breaking_treatments' => !empty($row['dormancy_breaking_treatments']) ? $row['dormancy_breaking_treatments'] : null,
            'describe_dormancy_treatment' => !empty($row['describe_the_dormancy_breaking_treatment']) ? $row['describe_the_dormancy_breaking_treatment'] : null,
            'description' => !empty($row['other_detales']) ? $row['other_detales'] : null,
            'project_title' => !empty($row['project_title']) ? $row['project_title'] : null,
            'research_title' => !empty($row['research_title']) ? $row['research_title'] : null,
            'project_leader_name' => !empty($row['project_leader_name']) ? $row['project_leader_name'] : null,
            'research_leader_name' => !empty($row['research_leader_name']) ? $row['research_leader_name'] : null,
            'research_leader_mobile' => !empty($row['research_leader_mobile']) ? $row['research_leader_mobile'] : null,
            'project_no' => !empty($row['project_no']) ? $row['project_no'] : null,
            'research_no' => !empty($row['research_no']) ? $row['research_no'] : null,
            'accession_code' => !empty($row['accession_code']) ? $row['accession_code'] : null,
            'date_started_test_year' => !empty($row['date_started_test_year']) ? $row['date_started_test_year'] : null,
            'date_started_test_month' => !empty($row['date_started_test_month']) ? $row['date_started_test_month'] : null,
            'date_started_test_day' => !empty($row['date_started_test_day']) ? $row['date_started_test_day'] : null,
            'date_started_germination_counting_year' => !empty($row['date_started_germination_counting_year']) ? $row['date_started_germination_counting_year'] : null,
            'date_started_germination_counting_month' => !empty($row['date_started_germination_counting_month']) ? $row['date_started_germination_counting_month'] : null,
            'date_started_germination_counting_day' => !empty($row['date_started_germination_counting_day']) ? $row['date_started_germination_counting_day'] : null,
        ];
    }

    private function log(string $message)
    {
        echo "$message\n";
    }

}
