<?php

use Illuminate\Database\Seeder;

class SeedWeightTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\SeedWeight::class, 50)->create();
    }
}
