<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\General;
use App\Models\PlantHerbarium;
use Faker\Generator as Faker;

$factory->define(App\Models\PlantProperty::class, function (Faker $faker) {
    $plants = PlantHerbarium::pluck('id')->toArray();
    $generals = General::whereIn('type', ['sub_species', 'plant_type'])->pluck('id')->toArray();
    return [
        'plant_herbarium_id' => $faker->randomElement($plants),
        'general_id' => $faker->randomElement($generals),
    ];
});
