<?php

use Illuminate\Database\Seeder;

class MedicinalPlantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\MedicinalPlant::class, 50)->create();
    }
}
