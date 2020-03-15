<?php

use App\Imports\PaleobotanyImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class PaleontologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new PaleobotanyImport(), public_path('/excels/paleobotany.xls'));
    }
}
