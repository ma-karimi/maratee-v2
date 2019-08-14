<?php

use Illuminate\Database\Seeder;

class SeedFeatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\seedFeature::class, 50)->create();
    }
}
