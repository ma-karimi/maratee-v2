<?php

use Illuminate\Database\Seeder;

class MedicinalPlantTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\MedicinalPlantType::class, 10000)->create();
    }
}
