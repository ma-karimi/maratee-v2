<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\City::class, function (Faker $faker) {
    $provinces = \App\Models\Province::pluck('id')->toArray();

    return [
        'name' => make_json($faker->name),
        'code' => $faker->word,
        'province_id' => $faker->randomElement($provinces),
    ];
});
