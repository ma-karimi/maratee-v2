<?php

use Illuminate\Database\Seeder;

class PlantGeneralTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\PlantGeneral::class, 50)->create();
    }
}
