<?php

use App\Imports\MedicinalApplicationImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class MedicinalApplicationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new MedicinalApplicationImport(), public_path('/excels/medicinal_app_new.xlsx'));
    }
}
