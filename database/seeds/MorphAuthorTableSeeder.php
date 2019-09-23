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
        $plants = \App\Models\PlantHerbarium::all();
        $authors = \App\Models\Actor::limit(5)->pluck('id')->toArray();
        foreach ($plants as $plant) {
            $plant->authors()->attach($authors);
        }
    }
}
