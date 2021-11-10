<?php


namespace App\Imports;

use App\Models\SeedGeneral;
use App\Models\SeedMorphologyField;
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

        if (!empty($row)) {
//            $row = $this->storeCollection($row);
            $row = collect($row)->filter()->all();
            $model = SeedMorphologyField::create($this->data($row));
            $this->log('SeedMorphologyField:' . $model->id);
        }
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
        return [
            'soil_ph' => $row['soil_ph'] ?? null,
            'soil_ec' => $row['soil_ec'] ?? null,
            'soil_depth' => $row['soil_depth'] ?? null,
            'sand' => $row['sand'] ?? null,
            'loam' => !empty($row['loam']) ? "{$row['loam']}" :  null,
            'clay' => !empty($row['clay']) ? "{$row['clay']}" :  null,
            'soil_texture' => !empty($row['soil_texture']) ? "{$row['soil_texture']}" :  null,
            'n' => !empty($row['n']) ? "{$row['n']}" :  null,
            'p' => !empty($row['p']) ? "{$row['p']}" :  null,
            'k' => !empty($row['k']) ? "{$row['k']}" :  null,
            'soil_organic_matter' => !empty($row['soil_organic_matter']) ? "{$row['soil_organic_matter']}" :  null,
            'source_of_water' => !empty($row['source_of_water']) ? "{$row['source_of_water']}" :  null,
            'irrigation_system' => $row['irrigation_system'] ?? null,
            'irrigation_circuit' => $row['irrigation_circuit'] ?? null,
            'irrigation_time' => $row['irrigation_time'] ?? null,
            'flow_rate' => $row['flow_rate'] ?? null,
            'water' => $row['water'] ?? null,
            'water_ec' => $row['water_ec'] ?? null,
            'name' => $row['name'] ?? '',
        ];
    }

    private function log(string $message)
    {
        echo "$message\n";
    }

}
