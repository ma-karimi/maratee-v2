<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
$return=[];
foreach (\App\Models\Plant::all() as $index => $item) {

    $factory->define(App\Models\Taxonomy::class, function (Faker $faker) use ($item) {
        $plant_family_generals = \App\Models\General::where('type', 'family')->pluck('id')->toArray();
        $plant_genus_generals = \App\Models\General::where('type', 'genus')->pluck('id')->toArray();
        $plant_specie_generals = \App\Models\General::where('type', 'specie')->pluck('id')->toArray();
        $plant_sub_specie_generals = \App\Models\General::where('type', 'sub_specie')->pluck('id')->toArray();
        $plant_type_generals = \App\Models\General::where('type', 'plant_type')->pluck('id')->toArray();
        $plant_variety_generals = \App\Models\General::where('type', 'variety')->pluck('id')->toArray();
        $return= [
            'genus_id' => $faker->randomElement($plant_genus_generals),
            'species_id' => $faker->randomElement($plant_specie_generals),
            'variety_id' => ($faker->randomElement($plant_variety_generals) % 3) ? $faker->randomElement($plant_variety_generals) : null,
            'family_id' => $faker->randomElement($plant_family_generals),
            'plant_id' => $item->id,
            'tip_type_id' => $faker->randomElement($plant_type_generals),
            'subspecies_id' => $faker->randomElement($plant_sub_specie_generals),
            'type_description' => make_json($faker->word),
        ];

    });

}
return $return;
