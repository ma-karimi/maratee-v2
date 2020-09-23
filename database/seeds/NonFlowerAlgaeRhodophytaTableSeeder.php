<?php

use App\Imports\NonFlowerAlgaeRhodophytaImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class NonFlowerAlgaeRhodophytaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new NonFlowerAlgaeRhodophytaImport(), public_path('/excels/Algae-list-revised-7-04-1399.xlsx'));
    }
}
