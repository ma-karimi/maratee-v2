<?php

use Illuminate\Database\Seeder;

class PlantPropertyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\PlantProperty::class, 500)->create();
    }
}
