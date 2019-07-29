<?php

use Illuminate\Database\Seeder;

class SeedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Seed::class, 50)->create();
    }
}
