<?php

use Illuminate\Database\Seeder;

class PlantFactorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\PlantFactor::class, 50)->create();
    }
}
