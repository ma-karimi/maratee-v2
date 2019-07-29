<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Country::class, function (Faker $faker) {
    $continents = \App\Models\Continent::pluck('id')->toArray();

    return [
        'code' => $faker->word,
        'name' => make_json($faker->name),
        'continent_id' => $faker->randomElement($continents),
    ];
});
