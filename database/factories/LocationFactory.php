<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Location::class, function (Faker $faker) {
    return [
        'address_id' => function () {
            return factory(App\Models\Address::class)->create()->id;
        },
        'region_id' => function () {
            return factory(App\Models\Region::class)->create()->id;
        },
        'altitude' => $faker->randomNumber(),
        'point' => $faker->word,
        'name' => make_json($faker->name),
        'description' => make_json($faker->text),
    ];
});
