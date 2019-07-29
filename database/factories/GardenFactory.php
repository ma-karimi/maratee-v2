<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Garden::class, function (Faker $faker) {
    return [
        'region' => make_json($faker->word),
        'section' => make_json($faker->word),
        'number' => make_json($faker->word),
    ];
});
