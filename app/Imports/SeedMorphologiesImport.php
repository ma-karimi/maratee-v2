<?php


namespace App\Imports;

use App\Models\SeedGeneral;
use App\Models\SeedMorphology;
use App\Models\SeedMorphologyField;
use Exception;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class SeedMorphologiesImport implements OnEachRow, WithHeadingRow
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
        throw_if(SeedMorphologyField::firstWhere(['name' => $row['fieldstation_name']]), new Exception('Field/station name are required and dont exist Seed Morphology Fields'));
        if (!empty($row) && !empty($row['accession_code']) && !empty($row['specimen_typecollection_name'])) {
            $row = $this->storeCollection($row);
            $row = collect($row)->filter()->all();
            $model = SeedMorphology::create($this->data($row));
            $this->log('SeedMorphology:' . $model->id);
        }

    }

    private function keys()
    {
        return [
            "accession_code" => null,
            "specimen_typecollection_name" => null,
            "regeneration_and_evaluation_code" => null,
            "fieldstation_name" => null,
            "name_of_organization" => null,
            "name_of_departmentgroup" => null,
            "project_title" => null,
            "research_title" => null,
            "project_leader_name" => null,
            "research_leader_name" => null,
            "project_no" => null,
            "research_no" => null,
            "voucher_no_released_by_tari" => null,
            "family" => null,
            "genus" => null,
            "species" => null,
            "subspecies" => null,
            "persian_name" => null,
            "plant_density_per_hectare" => null,
            "observation" => null,
            "sowing_date_year" => null,
            "sowing_date_month" => null,
            "sowing_date_day" => null,
            "observation_date_year" => null,
            "observation_date_month" => null,
            "observation_date_day" => null,
            "start_date_of_flowering_year" => null,
            "start_date_of_flowering_month" => null,
            "start_date_of_flowering_day" => null,
            "flowering_date_year" => null,
            "flowering_date_month" => null,
            "flowering_date_day" => null,
            "seed_ripening_date_year" => null,
            "seed_ripening_date_month" => null,
            "seed_ripening_date_day" => null,
            "plant_establishment" => null,
            "describe_the_fieldgreenhouse_operations" => null,
            "other_detales" => null,
            "replication_or_block_number_in_experiment" => null,
            "observation_no" => null,
            "quantitative_trait" => null,
            "qualitative_trait" => null,
        ];
    }


    private function storeCollection($row)
    {
        $row['collection_id'] = null;
        if (!empty($row['specimen_typecollection_name'])) {
            $row['collection_id'] = SeedGeneral::firstOrCreate(['name' => $row['specimen_typecollection_name'], 'type_id' => 19])->id;
        }
        $row['field_id'] = null;
        if (!empty($row['fieldstation_name'])) {
            $row['field_id'] = SeedMorphologyField::firstWhere(['name' => $row['fieldstation_name']])->id;
        }

        return $row;
    }

    private function data(array $row)
    {
        $organization = [
            'name_en' => $row['name_of_organization'] ?? '',
            'city' => $row['city'] ?? '',
            'phone' => $row['phone'] ?? '',
            'fax' => $row['fax'] ?? '',
            'email' => $row['email'] ?? '',
            'department_name' => $row['name_of_departmentgroup'] ?? ''
        ];

        $quantitatives = [];
        for ($i = 1; $i = 100; $i++) {
            $d = $row['replication_or_block_number_' . $i];
            $g = $row['observation_no_' . $i];
            if (!empty($d) && !empty($g)) {
                $quantitatives[] = ['replication_or_block_number' => $d, 'observation_no' => $g];
            }
        }
        return [
            'organization' => $organization,
            'quantitatives' => $quantitatives,
            'collection_id' => $row['collection_id'],
            'accession_code' => $row['accession_code'],
            'field_id' => $row['field_id'] ?? null,
            'regeneration_code' => $row['regeneration_and_evaluation_code'] ?? null,
            'department_name' => !empty($row['department_name']) ? $row['department_name'] : null,
            'replication_or_block_number' => !empty($row['replication_or_block_number']) ? $row['replication_or_block_number'] : null,
            'plant_density' => !empty($row['plant_density_per_hectare']) ? $row['plant_density_per_hectare'] : null,
            'observation' => !empty($row['observation']) ? $row['observation'] : null,
            'sowing_date_year' => !empty($row['sowing_date_year']) ? $row['sowing_date_year'] : null,
            'sowing_date_month' => !empty($row['sowing_date_month']) ? $row['sowing_date_month'] : null,
            'sowing_date_day' => !empty($row['sowing_date_day']) ? $row['sowing_date_day'] : null,
            'observation_date_year' => !empty($row['observation_date_year']) ? $row['observation_date_year'] : null,
            'observation_date_month' => !empty($row['observation_date_month']) ? $row['observation_date_month'] : null,
            'observation_date_day' => !empty($row['observation_date_day']) ? $row['observation_date_day'] : null,
            'start_date_of_flowering_year' => !empty($row['start_date_of_flowering_year']) ? $row['start_date_of_flowering_year'] : null,
            'start_date_of_flowering_month' => !empty($row['start_date_of_flowering_month']) ? $row['start_date_of_flowering_month'] : null,
            'start_date_of_flowering_day' => !empty($row['start_date_of_flowering_day']) ? $row['start_date_of_flowering_day'] : null,
            'flowering_date_year' => !empty($row['flowering_date_year']) ? $row['flowering_date_year'] : null,
            'flowering_date_month' => !empty($row['flowering_date_month']) ? $row['flowering_date_month'] : null,
            'flowering_date_day' => !empty($row['flowering_date_day']) ? $row['flowering_date_day'] : null,
            'seed_ripening_date_year' => !empty($row['seed_ripening_date_year']) ? $row['seed_ripening_date_year'] : null,
            'seed_ripening_date_month' => !empty($row['seed_ripening_date_month']) ? $row['seed_ripening_date_month'] : null,
            'seed_ripening_date_day' => !empty($row['seed_ripening_date_day']) ? $row['seed_ripening_date_day'] : null,
            'project_leader_name' => !empty($row['project_leader_name']) ? $row['project_leader_name'] : null,
            'research_leader_name' => !empty($row['research_leader_name']) ? $row['research_leader_name'] : null,
            'project_no' => !empty($row['project_no']) ? $row['project_no'] : null,
            'research_no' => !empty($row['research_no']) ? $row['research_no'] : null,
            'project_title' => $row['project_title'] ?? null,
            'research_title' => $row['research_title'] ?? null,
            'plant_establishment' => $row['plant_establishment'] ?? null,
            'describe_the_fieldgreenhouse_operations' => $row['describe_the_fieldgreenhouse_operations'] ?? null,
            'other_detales' => $row['other_detales'] ?? null,

        ];
    }

    private function log(string $message)
    {
        echo "$message\n";
    }

}
