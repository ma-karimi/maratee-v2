<?php

use Illuminate\Database\Seeder;

class OriginalNonflowerGeneralTableSeeder extends Seeder
{


    public $substrates = [

        ['name' => 'Tree', 'type' => 'lichen'],
        ['name' => 'Wood', 'type' => 'lichen'],
        ['name' => 'Stone', 'type' => 'lichen'],
        ['name' => 'Rock', 'type' => 'lichen'],
        ['name' => 'Soil', 'type' => 'lichen'],
        ['name' => 'Moss', 'type' => 'lichen'],
        ['name' => 'Building', 'type' => 'lichen'],
        ['name' => 'Tree', 'type' => 'moss'],
        ['name' => 'Soil', 'type' => 'moss'],
        ['name' => 'Sweet water', 'type' => 'diatom'],
        ['name' => 'Salty water', 'type' => 'diatom'],
        ['name' => 'Lichen', 'type' => 'layer'],
        ['name' => 'Moss', 'type' => 'layer'],
        ['name' => 'Diatom', 'type' => 'layer'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->substrates as $type) {
            \App\Models\NonflowerGeneral::create(
                ['name' => $type['name'], 'type' => $type['type']]
            );
        }

    }

}
