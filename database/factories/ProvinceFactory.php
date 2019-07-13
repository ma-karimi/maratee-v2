<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Province::class, function (Faker $faker) {
    return [
        'country_id' => function () {
            return factory(App\Models\Country::class)->create()->id;
        },
        'name' => make_json($faker->name),
    ];
});
