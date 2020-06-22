<?php

use App\Imports\NonFlowerAlgaeImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class NonflowerAlgaeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new NonFlowerAlgaeImport(), public_path('/excels/algae.xlsx'));
    }
}
