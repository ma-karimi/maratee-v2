<?php

use Illuminate\Database\Seeder;

class SeedChemicalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\SeedChemical::class, 50)->create();
    }
}
