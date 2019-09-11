<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Soil::class, function (Faker $faker) {
    return [
        'ph_type_id' => $faker->randomKey(\App\Models\Soil::PH),
        'features' => make_json($faker->text),
        'description' => make_json($faker->text),
    ];
});
