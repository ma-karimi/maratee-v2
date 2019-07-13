<?php

use Illuminate\Database\Seeder;

class SoilFeatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\SoilFeature::class, 50)->create();
    }
}
