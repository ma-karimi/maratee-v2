<?php

use App\Imports\MedicinalImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class MedicinalPlantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new MedicinalImport(), public_path('/excels/medicinal.xlsx'));
    }
}
