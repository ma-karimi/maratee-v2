<?php

use Illuminate\Database\Seeder;
use PragmaRX\Countries\Package\Countries;

class PlantLifeFormTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\PlantLifeForm::class, 50)->create();
    }
}
