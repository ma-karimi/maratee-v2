<?php

use Illuminate\Database\Seeder;

class MorphAuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plants = \App\Models\Plant::all();
        $actors = \App\Models\Actor::limit(5)->pluck('id')->toArray();
        foreach ($plants as $plant) {
            $plant->actors()->attach($actors);
        }
    }
}
