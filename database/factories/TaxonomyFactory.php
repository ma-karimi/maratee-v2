<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;


    $factory->define(App\Models\Taxonomy::class, function (Faker $faker) {
        $plant_family_generals = \App\Models\General::where('type', 'family')->pluck('id')->toArray();
        $plant_genus_generals = \App\Models\General::where('type', 'genus')->pluck('id')->toArray();
        $plant_specie_generals = \App\Models\General::where('type', 'specie')->pluck('id')->toArray();
        $plant_sub_specie_generals = \App\Models\General::where('type', 'sub_specie')->pluck('id')->toArray();
        $plant_variety_generals = \App\Models\General::where('type', 'variety')->pluck('id')->toArray();
        return [
            'name' => make_json($faker->word),
            'genus_id' => $faker->randomElement($plant_genus_generals),
            'species_id' => $faker->randomElement($plant_specie_generals),
            'variety_id' => ($faker->randomElement($plant_variety_generals) % 3) ? $faker->randomElement($plant_variety_generals) : null,
            'family_id' => $faker->randomElement($plant_family_generals),
            'subspecies_id' => $faker->randomElement($plant_sub_specie_generals),
        ];
    });



