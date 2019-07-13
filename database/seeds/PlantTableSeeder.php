<?php

use Illuminate\Database\Seeder;

class PlantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Plant::class, 50)->create();
    }
}
