<?php

use Illuminate\Database\Seeder;

class GardenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\InternalHabitat::class, 50)->create();
    }
}
