<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Language::class, function (Faker $faker) {
    return [
        'name' => make_json($faker->name),
        'code' => $faker->word,
    ];
});
