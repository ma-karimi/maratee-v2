<?php

use App\Imports\ExoticTaxonomyImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class ExoticTaxonomyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new ExoticTaxonomyImport(), public_path('/excels/exotic-flower.xls'));
    }
}
