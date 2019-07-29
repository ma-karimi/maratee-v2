<?php

use Illuminate\Database\Seeder;

class GeologyAgeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\GeologyAge::class, 50)->create();
    }
}
