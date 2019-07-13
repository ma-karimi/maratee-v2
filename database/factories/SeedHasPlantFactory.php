<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\SeedHasPlant::class, function (Faker $faker) {
    return [
        'seed_id' => $faker->numberBetween(1,50),
        'plant_id' => $faker->numberBetween(1,50),
    ];
});
