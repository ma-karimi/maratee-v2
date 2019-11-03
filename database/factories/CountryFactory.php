<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Country::class, function (Faker $faker) {
    $continents = \App\Models\Continent::pluck('id')->toArray();

    return [
        'name' => $faker->word,
        'continent_id' => $faker->randomElement($continents),
    ];
});
