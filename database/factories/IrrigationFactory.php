<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Irrigation::class, function (Faker $faker) {
    return [
        'type' => $faker->word,
        'description' => make_json($faker->text),
    ];
});
