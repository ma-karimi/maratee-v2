<?php

use App\Models\General;
use Illuminate\Database\Seeder;

class GeneralTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        factory(General::class, 50)->create();

    }
}
