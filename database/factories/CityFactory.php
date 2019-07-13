<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\City::class, function (Faker $faker) {
    return [
        'name' => make_json($faker->name),
        'code' => $faker->word,
        'province_id' => function () {
            return factory(App\Models\Province::class)->create()->id;
        },
    ];
});
