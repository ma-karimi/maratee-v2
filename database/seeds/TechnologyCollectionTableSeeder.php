<?php

use Illuminate\Database\Seeder;

class TechnologyCollectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Technology::class, 50)->create();
    }
}
