<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Garden::class, function (Faker $faker) {
    return [
        'region' => $faker->word,
        'section' => $faker->word,
        'number' => $faker->word,
    ];
});
