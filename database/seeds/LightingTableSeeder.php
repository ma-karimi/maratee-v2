<?php

use Illuminate\Database\Seeder;

class LightingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Lighting::class, 50)->create();
    }
}
