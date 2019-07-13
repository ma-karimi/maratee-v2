<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Address::class, function (Faker $faker) {
    return [
        'city_id' => function () {
            return factory(App\Models\City::class)->create()->id;
        },
        'village_id' => function () {
            return factory(App\Models\Village::class)->create()->id;
        },
        'address' => $faker->word,
    ];
});
