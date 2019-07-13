<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\GeologyAge::class, function (Faker $faker) {
    return [
        'era' => $faker->word,
        'period' => $faker->word,
        'epoch' => $faker->word,
        'stage' => $faker->word,
    ];
});
