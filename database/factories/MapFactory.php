<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Map::class, function (Faker $faker) {
    return [
        'reference_year' => $faker->dateTimeBetween(),
        'scale' => $faker->word,
    ];
});
