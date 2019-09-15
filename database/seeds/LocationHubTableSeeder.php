<?php

use Illuminate\Database\Seeder;

class LocationHubTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(\App\Models\LocationHub::class, 50)->create();
    }
}
