<?php

use App\Imports\NonFlowerTaxonomyImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class NonFlowerTaxonomyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new NonFlowerTaxonomyImport(), public_path('/excels/nonflower_taxonomies.xls'));
    }
}
