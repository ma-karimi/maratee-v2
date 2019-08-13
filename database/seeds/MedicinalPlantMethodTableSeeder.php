<?php

use Illuminate\Database\Seeder;

class MedicinalPlantMethodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\MedicinalPlantMethod::class, 50)->create();
    }
}
