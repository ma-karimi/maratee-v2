<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Country::class, function (Faker $faker) {
    return [
        'code' => $faker->word,
        'name' => make_json($faker->name),
        'continent_id' => function () {
            return factory(App\Models\Continent::class)->create()->id;
        },
    ];
});
