<?php

use Illuminate\Database\Seeder;
use PragmaRX\Countries\Package\Countries;

class LifeFormTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(\App\Models\LifeForm::class, 50)->create();
        factory(\App\Models\PlantLifeForm::class, 50)->create();
    }
}
