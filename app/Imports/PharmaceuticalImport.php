<?php


namespace App\Imports;

use App\Models\MedicinalLocation;
use App\Models\MedicinalPlantType;
use App\Models\Product;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class PharmaceuticalImport implements OnEachRow, WithHeadingRow
{


    public function onRow(Row $row)
    {
        ini_set('max_execution_time', 9000);
//        ini_set('memory_limit', '2000M');
        $row = $row->toArray();

        if (!empty($row)) {

            $row = $this->storeForm($row);
            $model = Product::create(Arr::except($row, ['pharmaceutical_form']));
            $this->log('Pharmaceutical:' . $model->id);
        }

    }

    private function storeForm($row)
    {
        $row['pharmaceutical_form_id'] = null;
        if (!empty($row['pharmaceutical_form'])) {
            $row['pharmaceutical_form_id'] = MedicinalPlantType::firstOrCreate(['name' => $row['pharmaceutical_form'], 'type_id' => 7])->id;
        }

        return $row;
    }

    private function log(string $message)
    {
        echo "$message\n";
    }

}
