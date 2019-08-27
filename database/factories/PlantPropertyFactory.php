<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\General;
use App\Models\Plant;
use Faker\Generator as Faker;

$factory->define(App\Models\PlantProperty::class, function (Faker $faker) {
    $plants = Plant::pluck('id')->toArray();
    $generals = General::whereIn('type', ['sub_species', 'plant_type'])->pluck('id')->toArray();
    return [
        'plant_id' => $faker->randomElement($plants),
        'general_id' => $faker->randomElement($generals),
    ];
});
