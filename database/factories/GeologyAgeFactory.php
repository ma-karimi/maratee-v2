<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\GeologyAge::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'type' => $faker->numberBetween(1,4),
    ];
});
