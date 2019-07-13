<?php

use Illuminate\Database\Seeder;

class SoilTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Soil::class, 50)->create();
    }
}
