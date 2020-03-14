<?php

use App\Imports\MedicinalLocationImport;
use App\Imports\PharmaceuticalImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class PharmaceuticalTableSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        Excel::import(new PharmaceuticalImport(), public_path('/excels/pharma.xlsx'));

    }
}
