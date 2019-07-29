<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Province::class, function (Faker $faker) {
    $countries = \App\Models\Country::pluck('id')->toArray();
    return [
        'country_id' => $faker->randomElement($countries),
        'name' => make_json($faker->name),
    ];
});
