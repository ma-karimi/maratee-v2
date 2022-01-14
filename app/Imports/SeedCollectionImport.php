<?php


namespace App\Imports;

use App\Models\SeedCollection;
use App\Models\SeedGeneral;
use Exception;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;
use Throwable;

class SeedCollectionImport implements OnEachRow, WithHeadingRow
{
    /**
     * @throws Throwable
     */
    public function onRow(Row $row)
    {

        $row = $row->toArray();
        foreach (array_keys($this->keys()) as $key) {
            throw_if(!in_array($key, array_keys($row)), new Exception("{$key} column is required"));
        }
        throw_if(empty($row['accession_code_released_by_nrgb']), new Exception('accession_code_released_by_nrgb field is required'));
        if (!empty($row) && !empty($row['accession_code_released_by_nrgb'])) {
            $row = $this->storeCollection($row);
            $row = collect($row)->filter()->all();
            $model = SeedCollection::create($this->data($row));
            $this->log('SeedCollection:' . $model->id);
        }
    }

    private function keys()
    {
        return [
            "name_of_organization" => null,
            "name_of_departmentgroup" => null,
            "city" => "كرج",
            "phone" => null,
            "fax" => null,
            "email_address" => null,
            "project_title" => null,
            "research_title" => null,
            "project_leader_name" => null,
            "research_leader_name" => null,
            "project_no" => null,
            "research_no" => null,
            "field_code_encoded_by_collector" => "14116",
            "field_code_corrected_by_nrgb" => null,
            "accession_code_released_by_nrgb" => 1,
            "voucher_no_released_by_tari" => null,
            "family" => "Papilionaceae",
            "genus" => "Trifolium",
            "species" => "hybridum",
            "subspecies" => null,
            "variety" => null,
            "persian_name" => "shabdare doragh",
            "local_name" => null,
            "country" => "Iran",
            "provincestate" => "Alborz",
            "region" => "البرز",
            "villageroad_no_or_name" => "",
            "latitude_degree" => null,
            "latitude_minute" => null,
            "latitude_second" => null,
            "longitude_degree" => null,
            "longitude_minute" => null,
            "longitude_second" => null,
            "altitude_m" => null,
            "gps_used" => null,
            "gps_datum" => null,
            "land_form" => null,
            "slope_aspect" => "",
            "slope" => "",
            "habitat" => null,
            "soil_depth" => null,
            "soil_texture" => null,
            "drainage" => null,
            "soil_ph" => null,
            "soil_salinity" => null,
            "soil_lime" => null,
            "climate" => null,
            "community_type" => null,
            "associated_species" => "",
            "soil_erosion" => null,
            "area_sampled_m2" => null,
            "number_of_plants_sampled" => null,
            "approximate_number_or_area_of_plant_available_m2" => null,
            "specimen_type" => null,
            "flowering_time_month" => null,
            "pollination_type" => null,
            "pollination_agent" => null,
            "fruit_type" => null,
            "seeds_collected_from" => null,
            "date_harvesting_month" => null,
            "growth_form" => null,
            "plant_hight_cm" => null,
            "plant_mother_health" => null,
            "plant_consumption_value" => "Forage",
            "used_part" => null,
            "how_to_use" => null,
            "collection_date" => "1994/6/12",
            "shipping_date_year" => null,
            "shipping_date_month" => null,
            "shipping_date_day" => null,
            "plant_image_jpg_up_to_1_mb" => null,
            "herbarium_sample_image_jpg_up_to_1_mb" => null,
            "other_details" => null,
            "special_advice_on_seed" => null,
        ];
    }

    private function storeCollection($row)
    {
        $row['land_form_id'] = null;
        if (!empty($row['land_form'])) {
            $row['land_form_id'] = SeedGeneral::firstOrCreate(['name' => $row['land_form'], 'type_id' => 2])->id;
        }
        $row['slope_aspect_id'] = null;
        if (!empty($row['slope_aspect'])) {
            $row['slope_aspect_id'] = SeedGeneral::firstOrCreate(['name' => $row['slope_aspect'], 'type_id' => 3])->id;
        }
        $row['general_habitat_id'] = null;
        if (!empty($row['general_habitat'])) {
            $row['general_habitat_id'] = SeedGeneral::firstOrCreate(['name' => $row['general_habitat'], 'type_id' => 29])->id;
        }

        $row['soil_depth_id'] = null;
        if (!empty($row['soil_depth'])) {
            $row['soil_depth_id'] = SeedGeneral::firstOrCreate(['name' => $row['soil_depth'], 'type_id' => 4])->id;
        }

        $row['soil_texture_id'] = null;
        if (!empty($row['soil_texture'])) {
            $row['soil_texture_id'] = SeedGeneral::firstOrCreate(['name' => $row['soil_texture'], 'type_id' => 5])->id;
        }

        $row['drainage_id'] = null;
        if (!empty($row['drainage'])) {
            $row['drainage_id'] = SeedGeneral::firstOrCreate(['name' => $row['drainage'], 'type_id' => 6])->id;
        }

        $row['soil_salinity_id'] = null;
        if (!empty($row['soil_salinity'])) {
            $row['soil_salinity_id'] = SeedGeneral::firstOrCreate(['name' => $row['soil_salinity'], 'type_id' => 7])->id;
        }

        $row['soil_lime_id'] = null;
        if (!empty($row['soil_lime'])) {
            $row['soil_lime_id'] = SeedGeneral::firstOrCreate(['name' => $row['soil_lime'], 'type_id' => 8])->id;
        }

        $row['soil_erosion_id'] = null;
        if (!empty($row['soil_erosion'])) {
            $row['soil_erosion_id'] = SeedGeneral::firstOrCreate(['name' => $row['soil_erosion'], 'type_id' => 9])->id;
        }

        $row['specimen_type_id'] = null;
        if (!empty($row['specimen_type'])) {
            $row['specimen_type_id'] = SeedGeneral::firstOrCreate(['name' => $row['specimen_type'], 'type_id' => 1])->id;
        }

        $row['fruit_type_id'] = null;
        if (!empty($row['fruit_type'])) {
            $row['fruit_type_id'] = SeedGeneral::firstOrCreate(['name' => $row['fruit_type'], 'type_id' => 12])->id;
        }

        $row['seed_collected_from_id'] = null;
        if (!empty($row['seed_collected_from'])) {
            $row['seed_collected_from_id'] = SeedGeneral::firstOrCreate(['name' => $row['seed_collected_from'], 'type_id' => 13])->id;
        }

        $row['life_form_id'] = null;
        if (!empty($row['life_form'])) {
            $row['life_form_id'] = SeedGeneral::firstOrCreate(['name' => $row['life_form'], 'type_id' => 14])->id;
        }

        $row['growth_form_id'] = null;
        if (!empty($row['growth_form'])) {
            $row['growth_form_id'] = SeedGeneral::firstOrCreate(['name' => $row['growth_form'], 'type_id' => 15])->id;
        }

        $row['plant_mother_health_id'] = null;
        if (!empty($row['plant_mother_health'])) {
            $row['plant_mother_health_id'] = SeedGeneral::firstOrCreate(['name' => $row['plant_mother_health'], 'type_id' => 16])->id;
        }

        $row['plant_consumption_value_id'] = null;
        if (!empty($row['plant_consumption_value'])) {
            $row['plant_consumption_value_id'] = SeedGeneral::firstOrCreate(['name' => $row['plant_consumption_value'], 'type_id' => 17])->id;
        }

        $row['pollination_type_id'] = null;
        if (!empty($row['pollination_type'])) {
            $row['pollination_type_id'] = SeedGeneral::firstOrCreate(['name' => $row['pollination_type'], 'type_id' => 10])->id;
        }
        $row['pollination_agent_id'] = null;
        if (!empty($row['pollination_agent'])) {
            $row['pollination_agent_id'] = SeedGeneral::firstOrCreate(['name' => $row['pollination_agent'], 'type_id' => 11])->id;
        }
        $row['used_part_id'] = null;
        if (!empty($row['used_part'])) {
            $row['used_part_id'] = SeedGeneral::firstOrCreate(['name' => $row['used_part'], 'type_id' => 18])->id;
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
        $taxonomy = [
            'family' => $row['family'] ?? '',
            'genus' => $row['genus'] ?? '',
            'species' => $row['species'] ?? '',
            'subspecies' => $row['subspecies'] ?? '',
            'variety' => $row['variety'] ?? '',
            'persian_name' => $row['persian_name'] ?? '',
            'local_name' => $row['local_name'] ?? '',
        ];
        $location = [
            'country_name' => $row['country'] ?? '',
            'provincestate' => $row['provincestate'] ?? '',
            'city' => $row['city'] ?? '',
            'region' => $row['region'] ?? '',
            'villageroad_no_or_name' => $row['villageroad_no_or_name'] ?? '',
            'altitude_m' => $row['altitude_m'] ?? '',
            'latitude_degree' => $row['latitude_degree'] ?? '',
            'latitude_minute' => $row['latitude_minute'] ?? '',
            'latitude_second' => $row['latitude_second'] ?? '',
            'longitude_degree' => $row['longitude_degree'] ?? '',
            'longitude_minute' => $row['longitude_minute'] ?? '',
            'longitude_second' => $row['longitude_second'] ?? '',
            "gps_used" => (bool)$row['gps_used'] ?? false,
            "gps_datum" => $row['gps_datum'] ?? '',
        ];
        $plantHeight = $row['plant_hight_cm'] ?? $row['plant_height'];
        return [
            'organization' => $organization,
            'taxonomy_data' => $taxonomy,
            'location' => $location,
            'accession_code' => $row['accession_code_released_by_nrgb'],
            'encoded_code_by_collector' => $row['field_code_encoded_by_collector'] ?? '',
            'corrected_code_by_nrgb' => $row['field_code_corrected_by_nrgb'] ?? '',
            'voucher_no' => $row['voucher_no_released_by_tari'] ?? '',
            'land_form_id' => !empty($row['land_form_id']) ? $row['land_form_id'] : null,
            'slope_aspect_id' => !empty($row['slope_aspect_id']) ? $row['slope_aspect_id'] : null,
            'slope_degree' => !empty($row['slope']) ? $row['slope'] : null,
            'general_habitat_id' => !empty($row['general_habitat_id']) ? $row['general_habitat_id'] : null,
            'soil_depth_id' => !empty($row['soil_depth_id']) ? $row['soil_depth_id'] : null,
            'soil_texture_id' => !empty($row['soil_texture_id']) ? $row['soil_texture_id'] : null,
            'drainage_id' => !empty($row['drainage_id']) ? $row['drainage_id'] : null,
            'soil_ph' => !empty($row['soil_ph']) ? $row['soil_ph'] : '',
            'soil_salinity_id' => !empty($row['soil_salinity_id']) ? $row['soil_salinity_id'] : null,
            'soil_lime_id' => !empty($row['soil_lime_id']) ? $row['soil_lime_id'] : null,
            'soil_erosion_id' => !empty($row['soil_erosion_id']) ? $row['soil_erosion_id'] : null,
            'area_sampled' => !empty($row['area_sampled_m2']) ? $row['area_sampled_m2'] : null,
            'plants_sampled_no' => !empty($row['number_of_plants_sampled']) ? $row['number_of_plants_sampled'] : null,
            'area_occupancy' => !empty($row['area_occupancy']) ? $row['area_occupancy'] : null,
            'specimen_type_id' => !empty($row['specimen_type_id']) ? $row['specimen_type_id'] : null,
            'fruit_type_id' => !empty($row['fruit_type_id']) ? $row['fruit_type_id'] : null,
            'seed_collected_from_id' => !empty($row['seed_collected_from_id']) ? $row['seed_collected_from_id'] : null,
            'life_form_id' => !empty($row['life_form_id']) ? $row['life_form_id'] : null,
            'growth_form_id' => !empty($row['growth_form_id']) ? $row['growth_form_id'] : null,
            'plant_height' => !empty($row['plant_hight_cm'] ?? $row['plant_height']) ? $plantHeight : null,
            'plant_mother_health_id' => !empty($row['plant_mother_health_id']) ? $row['plant_mother_health_id'] : null,
            'plant_consumption_value_id' => !empty($row['plant_consumption_value_id']) ? $row['plant_consumption_value_id'] : null,
            'other_details' => !empty($row['other_details']) ? $row['other_details'] : null,
            'special_advise' => !empty($row['special_advise']) ? $row['special_advise'] : null,
            'collecting_date' => !empty($row['collecting_date']) ? $row['collecting_date'] : null,
            'date_harvesting_month' => !empty($row['date_harvesting_month']) ? $row['date_harvesting_month'] : null,
            'flowering_time_month' => !empty($row['flowering_time_month']) ? $row['flowering_time_month'] : null,
            'shipping_date_year' => !empty($row['shipping_date_year']) ? $row['shipping_date_year'] : null,
            'shipping_date_month' => !empty($row['shipping_date_month']) ? $row['shipping_date_month'] : null,
            'shipping_date_day' => !empty($row['shipping_date_day']) ? $row['shipping_date_day'] : null,
            'project_title' => !empty($row['project_title']) ? $row['project_title'] : null,
            'research_title' => !empty($row['research_title']) ? $row['research_title'] : '',
            'project_leader_name' => !empty($row['project_leader_name']) ? $row['project_leader_name'] : '',
            'research_leader_name' => !empty($row['research_leader_name']) ? $row['research_leader_name'] : '',
            'project_no' => !empty($row['project_no']) ? $row['project_no'] : '',
            'research_no' => !empty($row['research_no']) ? $row['research_no'] : '',
            'approximate_area_of_plant' => !empty($row['approximate_area_of_plant']) ? $row['approximate_area_of_plant'] : null,
            'description' => !empty($row['description']) ? $row['description'] : null,
            'community_type' => !empty($row['community_type']) ? $row['community_type'] : null,
            'associated_species' => !empty($row['associated_species']) ? $row['associated_species'] : null,
            'pollination_type_id' => !empty($row['pollination_type_id']) ? $row['pollination_type_id'] : null,
            'used_part_id' => !empty($row['used_part_id']) ? $row['used_part_id'] : null,
            'how_to_use' => !empty($row['how_to_use']) ? $row['how_to_use'] : null,
            'climate' => !empty($row['climate']) ? $row['climate'] : null,
            'special_advice_on_seed' => !empty($row['special_advice_on_seed']) ? $row['special_advice_on_seed'] : null,

        ];
    }

    private function log(string $message)
    {
        echo "$message\n";
    }

}
