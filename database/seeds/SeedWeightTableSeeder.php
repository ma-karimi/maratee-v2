<?php
namespace Database\Seeders;
use App\Imports\SeedWeightImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;


class SeedWeightTableSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new SeedWeightImport(), public_path('/excels/seed_weight2.xlsx'));
    }
}
