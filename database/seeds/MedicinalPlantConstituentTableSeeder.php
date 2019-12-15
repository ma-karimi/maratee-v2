<?php

use Illuminate\Database\Seeder;

class MedicinalPlantConstituentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\MedicinalLocationConstituent::class, 50)->create();
    }
}
