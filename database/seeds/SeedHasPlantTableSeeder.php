<?php

use Illuminate\Database\Seeder;

class SeedHasPlantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\SeedHasPlant::class, 50)->create();
    }
}
