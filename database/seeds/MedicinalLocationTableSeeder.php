<?php

use App\Imports\MedicinalLocationImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class MedicinalLocationTableSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {

        ini_set('max_execution_time', 9000);
        ini_set('memory_limit', '-1');
//        Excel::import(new MedicinalLocationImport(), public_path('/excels/MedicinalLocation.xlsx'));
        Excel::import(new MedicinalLocationImport(), public_path('/excels/99-05-7-new-Final-Medicinal-Plant.xlsx'));

    }
}
