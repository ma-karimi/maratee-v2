<?php

use Illuminate\Database\Seeder;

class SeedPlantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\SeedPlant::class, 50)->create();
    }
}
