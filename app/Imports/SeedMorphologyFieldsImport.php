<?php


namespace App\Imports;

use App\Models\SeedMorphologyField;
use Exception;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class SeedMorphologyFieldsImport implements OnEachRow, WithHeadingRow
{


    public function onRow(Row $row)
    {
//        ini_set('max_execution_time', 9000);
//        ini_set('memory_limit', '2000M');
        $row = $row->toArray();
        foreach (array_keys($this->keys()) as $key) {
            throw_if(!in_array($key, array_keys($row)), new Exception("{$key} column is required"));
        }
        throw_if(empty($row['fieldstation_name']), new Exception('Field/station name fields are required'));
        if (!empty($row['fieldstation_name'])) {
            $model = SeedMorphologyField::create($this->data($row));
            $this->log('SeedMorphologyField:' . $model->id);
        }
    }

    private function keys()
    {
        return [
            "fieldstation_name" => null,
            "field_or_greenhouse" => null,
            "country" => null,
            "provincestate" => null,
            "city" => null,
            "region" => null,
            "villageroad_no_or_name" => null,
            "latitude_degree" => null,
            "latitude_minute" => null,
            "latitude_second" => null,
            "longitude_degree" => null,
            "longitude_minute" => null,
            "longitude_second" => null,
            "altitude_m" => null,
            "gps_used" => null,
            "gps_datum" => null,
            "soil_ph" => null,
            "soil_ec_dsm" => null,
            "soil_depth_cm" => null,
            "sand" => null,
            "loam" => null,
            "clay" => null,
            "soil_texture" => null,
            "n" => null,
            "p" => null,
            "k" => null,
            "soil_organic_matter" => null,
            "source_of_water" => null,
            "irrigation_system" => null,
            "irrigation_circuit" => null,
            "irrigation_time" => null,
            "flow_rate_lh" => null,
            "water_ph" => null,
            "water_ec_dsm" => null,
            "attach_excel_file_of_long_term_meteorological_station_data" => null,
        ];
    }
//    private function storeCollection($row)
//    {
//        $row['collection_id'] = null;
//        if (!empty($row['collection'])) {
//            $row['collection_id'] = SeedGeneral::firstOrCreate(['name' => $row['collection'], 'type_id' => 19])->id;
//        }
//
//        return $row;
//    }

    private function data(array $row)
    {
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
        return [
            'soil_ph' => $row['soil_ph'] ?? null,
            'soil_ec' => $row['soil_ec_dsm'] ?? null,
            'soil_depth' => $row['soil_depth_cm'] ?? null,
            'sand' => $row['sand'] ?? null,
            'loam' => !empty($row['loam']) ? $row['loam'] : null,
            'clay' => !empty($row['clay']) ? $row['clay'] : null,
            'soil_texture' => !empty($row['soil_texture']) ? $row['soil_texture'] : null,
            'n' => !empty($row['n']) ? $row['n'] : null,
            'p' => !empty($row['p']) ? $row['p'] : null,
            'k' => !empty($row['k']) ? $row['k'] : null,
            'soil_organic_matter' => !empty($row['soil_organic_matter']) ? $row['soil_organic_matter'] : null,
            'source_of_water' => !empty($row['source_of_water']) ? $row['source_of_water'] : null,
            'irrigation_system' => $row['irrigation_system'] ?? null,
            'irrigation_circuit' => $row['irrigation_circuit'] ?? null,
            'irrigation_time' => $row['irrigation_time'] ?? null,
            'flow_rate' => $row['flow_rate_lh'] ?? null,
            'water' => $row['water_ph'] ?? null,
            'water_ec' => $row['water_ec_dsm'] ?? null,
            'name' => $row['fieldstation_name'] ?? '',
            'location' => $location
        ];
    }

    private function log(string $message)
    {
        echo "$message\n";
    }

}
