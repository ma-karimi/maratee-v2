<?php

use Illuminate\Database\Seeder;

class MedicinalPlantMorphologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\MedicinalPlantMorphology::class, 50)->create();
    }
}
