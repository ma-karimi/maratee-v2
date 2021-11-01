<?php
use App\Imports\SeedExchangesImport;
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
        Excel::import(new SeedExchangesImport(), public_path('/excels/seed_weight2.xlsx'));

    }
}
