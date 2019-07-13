<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Address::class, function (Faker $faker) {
    $cities = \App\Models\City::pluck('id')->toArray();
    $villages = \App\Models\Village::pluck('id')->toArray();

    return [
        'city_id' => $faker->randomElement($cities),
        'village_id' => $faker->randomElement($villages),
        'address' => make_json($faker->word),
    ];
});
