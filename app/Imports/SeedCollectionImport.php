<?php


namespace App\Imports;

use App\Models\SeedCollection;
use App\Models\SeedGeneral;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class SeedCollectionImport implements OnEachRow, WithHeadingRow
{


    public function onRow(Row $row)
    {
//        ini_set('max_execution_time', 9000);
//        ini_set('memory_limit', '2000M');
        $row = $row->toArray();

        if (!empty($row) && !empty($row['accession_code'])) {

            $row = $this->storeCollection($row);
            $row = collect($row)->filter()->all();
            $model = SeedCollection::create($this->data($row));
            $this->log('SeedWeight:' . $model->id);
        }

    }

    private function storeCollection($row)
    {
        $row['land_form_id'] = null;
        if (!empty($row['land_form_id'])) {
            $row['land_form_id'] = SeedGeneral::firstOrCreate(['name' => $row['land_form_id'], 'type_id' => 2])->id;
        }

        $row['slope_aspect_id'] = null;
        if (!empty($row['slope_aspect_id'])) {
            $row['slope_aspect_id'] = SeedGeneral::firstOrCreate(['name' => $row['slope_aspect_id'], 'type_id' => 3])->id;
        }

        $row['general_habitat_id'] = null;
        if (!empty($row['general_habitat_id'])) {
            $row['general_habitat_id'] = SeedGeneral::firstOrCreate(['name' => $row['general_habitat_id'], 'type_id' => 29])->id;
        }

        $row['soil_depth_id'] = null;
        if (!empty($row['soil_depth_id'])) {
            $row['soil_depth_id'] = SeedGeneral::firstOrCreate(['name' => $row['soil_depth_id'], 'type_id' => 4])->id;
        }

        $row['soil_texture_id'] = null;
        if (!empty($row['soil_texture_id'])) {
            $row['soil_texture_id'] = SeedGeneral::firstOrCreate(['name' => $row['soil_texture_id'], 'type_id' => 5])->id;
        }

        $row['drainage_id'] = null;
        if (!empty($row['drainage_id'])) {
            $row['drainage_id'] = SeedGeneral::firstOrCreate(['name' => $row['drainage_id'], 'type_id' => 6])->id;
        }

        $row['soil_salinity_id'] = null;
        if (!empty($row['soil_salinity_id'])) {
            $row['soil_salinity_id'] = SeedGeneral::firstOrCreate(['name' => $row['soil_salinity_id'], 'type_id' => 7])->id;
        }

        $row['soil_lime_id'] = null;
        if (!empty($row['soil_lime_id'])) {
            $row['soil_lime_id'] = SeedGeneral::firstOrCreate(['name' => $row['soil_lime_id'], 'type_id' => 8])->id;
        }

        $row['soil_erosion_id'] = null;
        if (!empty($row['soil_erosion_id'])) {
            $row['soil_erosion_id'] = SeedGeneral::firstOrCreate(['name' => $row['soil_erosion_id'], 'type_id' => 9])->id;
        }

        $row['specimen_type_collect_id'] = null;
        if (!empty($row['specimen_type_collect_id'])) {
            $row['specimen_type_collect_id'] = SeedGeneral::firstOrCreate(['name' => $row['specimen_type_collect_id'], 'type_id' => 1])->id;
        }

        $row['fruit_type_id'] = null;
        if (!empty($row['fruit_type_id'])) {
            $row['fruit_type_id'] = SeedGeneral::firstOrCreate(['name' => $row['fruit_type_id'], 'type_id' => 12])->id;
        }

        $row['seed_collected_from_id'] = null;
        if (!empty($row['seed_collected_from_id'])) {
            $row['seed_collected_from_id'] = SeedGeneral::firstOrCreate(['name' => $row['seed_collected_from_id'], 'type_id' => 13])->id;
        }

        $row['life_form_id'] = null;
        if (!empty($row['life_form_id'])) {
            $row['life_form_id'] = SeedGeneral::firstOrCreate(['name' => $row['life_form_id'], 'type_id' => 14])->id;
        }

        $row['growth_form_id'] = null;
        if (!empty($row['growth_form_id'])) {
            $row['growth_form_id'] = SeedGeneral::firstOrCreate(['name' => $row['growth_form_id'], 'type_id' => 15])->id;
        }

        $row['plant_mother_health_id'] = null;
        if (!empty($row['plant_mother_health_id'])) {
            $row['plant_mother_health_id'] = SeedGeneral::firstOrCreate(['name' => $row['plant_mother_health_id'], 'type_id' => 16])->id;
        }

        $row['plant_consumption_value_id'] = null;
        if (!empty($row['plant_consumption_value_id'])) {
            $row['plant_consumption_value_id'] = SeedGeneral::firstOrCreate(['name' => $row['plant_consumption_value_id'], 'type_id' => 17])->id;
        }

        $row['harvesting_time_id'] = null;
        if (!empty($row['harvesting_time_id'])) {
            $row['harvesting_time_id'] = SeedGeneral::firstOrCreate(['name' => $row['harvesting_time_id'], 'type_id' => 25])->id;
        }

        $row['flowering_time_id'] = null;
        if (!empty($row['flowering_time_id'])) {
            $row['flowering_time_id'] = SeedGeneral::firstOrCreate(['name' => $row['flowering_time_id'], 'type_id' => 25])->id;
        }

        return $row;
    }

    private function data(array $row)
    {

        return [
            'encoded_code_by_collector' => $row['encoded_code_by_collector'] ?? null,
            'corrected_code_by_nrgb' => $row['corrected_code_by_nrgb'] ?? null,
            'accession_code' => $row['accession_code'] ?? 0,
            'voucher_no' => $row['voucher_no'] ?? null,
            'organization_id' => !empty($row['organization_id']) ? "{$row['organization_id']}" : null,
            'location_id' => !empty($row['location_id']) ? "{$row['location_id']}" : null,
            'land_form_id' => !empty($row['land_form_id']) ? "{$row['land_form_id']}" : null,
            'slope_aspect_id' => !empty($row['slope_aspect_id']) ? "{$row['slope_aspect_id']}" : null,
            'slope_degree' => !empty($row['slope_degree']) ? "{$row['slope_degree']}" : null,
            'general_habitat_id' => !empty($row['general_habitat_id']) ? "{$row['general_habitat_id']}" : null,
            'soil_depth_id' => !empty($row['soil_depth_id']) ? "{$row['soil_depth_id']}" : null,
            'soil_texture_id' => !empty($row['soil_texture_id']) ? "{$row['soil_texture_id']}" : null,
            'drainage_id' => !empty($row['drainage_id']) ? "{$row['drainage_id']}" : null,
            'soil_ph' => !empty($row['soil_ph']) ? "{$row['soil_ph']}" : null,
            'soil_salinity_id' => !empty($row['soil_salinity_id']) ? "{$row['soil_salinity_id']}" : null,
            'soil_lime_id' => !empty($row['soil_lime_id']) ? "{$row['soil_lime_id']}" : null,
            'soil_erosion_id' => !empty($row['soil_erosion_id']) ? "{$row['soil_erosion_id']}" : null,
            'area_sampled' => !empty($row['area_sampled']) ? "{$row['area_sampled']}" : null,
            'plants_sampled_no' => !empty($row['plants_sampled_no']) ? "{$row['plants_sampled_no']}" : null,
            'area_occupancy' => !empty($row['area_occupancy']) ? "{$row['area_occupancy']}" : null,
            'specimen_type_collect_id' => !empty($row['specimen_type_collect_id']) ? "{$row['specimen_type_collect_id']}" : null,
            'fruit_type_id' => !empty($row['fruit_type_id']) ? "{$row['fruit_type_id']}" : null,
            'seed_collected_from_id' => !empty($row['seed_collected_from_id']) ? "{$row['seed_collected_from_id']}" : null,
            'project_id' => !empty($row['project_id']) ? "{$row['project_id']}" : null,
            'regeneration_and_evaluation_code' => !empty($row['regeneration_and_evaluation_code']) ? "{$row['regeneration_and_evaluation_code']}" : null,
            'life_form_id' => !empty($row['life_form_id']) ? "{$row['life_form_id']}" : null,
            'growth_form_id' => !empty($row['growth_form_id']) ? "{$row['growth_form_id']}" : null,
            'plant_height' => !empty($row['plant_height']) ? "{$row['plant_height']}" : null,
            'plant_mother_health_id' => !empty($row['plant_mother_health_id']) ? "{$row['plant_mother_health_id']}" : null,
            'plant_consumption_value_id' => !empty($row['plant_consumption_value_id']) ? "{$row['plant_consumption_value_id']}" : null,
            'other_details' => !empty($row['other_details']) ? "{$row['other_details']}" : null,
            'special_advise' => !empty($row['special_advise']) ? "{$row['special_advise']}" : null,
            'collecting_date' => !empty($row['collecting_date']) ? "{$row['collecting_date']}" : null,
            'harvesting_time_id' => !empty($row['harvesting_time_id']) ? "{$row['harvesting_time_id']}" : null,
            'flowering_time_id' => !empty($row['flowering_time_id']) ? "{$row['flowering_time_id']}" : null,
            'department_name' => !empty($row['department_name']) ? "{$row['department_name']}" : null,
            'organization_phone' => !empty($row['organization_phone']) ? "{$row['organization_phone']}" : null,
            'organization_fax' => !empty($row['organization_fax']) ? "{$row['organization_fax']}" : null,
            'organization_email' => !empty($row['organization_email']) ? "{$row['organization_email']}" : null,
            'shipping_date' => !empty($row['shipping_date']) ? "{$row['shipping_date']}" : null,
            'project_title' => !empty($row['project_title']) ? "{$row['project_title']}" : null,
            'research_title' => !empty($row['research_title']) ? "{$row['research_title']}" : null,
            'project_leader_name' => !empty($row['project_leader_name']) ? "{$row['project_leader_name']}" : null,
            'research_leader_name' => !empty($row['research_leader_name']) ? "{$row['research_leader_name']}" : null,
            'project_no' => !empty($row['project_no']) ? "{$row['project_no']}" : null,
            'research_no' => !empty($row['research_no']) ? "{$row['research_no']}" : null,
            'approximate_area_of_plant' => !empty($row['approximate_area_of_plant']) ? "{$row['approximate_area_of_plant']}" : null,
            'description' => !empty($row['description']) ? "{$row['description']}" : null,
            'dna' => !empty($row['dna']) ? "{$row['dna']}" : 0,

        ];
    }

    private function log(string $message)
    {
        echo "$message\n";
    }

}
