<?php

use Illuminate\Database\Seeder;

class PlantApplicationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\PlantApplication::class, 50)->create();
    }
}
