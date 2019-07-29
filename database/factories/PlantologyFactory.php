<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Plantology::class, function (Faker $faker) {
    return [
        'name' => make_json($faker->name),
        'description' => make_json($faker->text),
        'type' => $faker->randomElement(['phytogeography, phenology, plant_type']),
    ];
});
