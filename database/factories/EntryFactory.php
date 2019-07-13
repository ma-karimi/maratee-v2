<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Entry::class, function (Faker $faker) {
    return [
        'type' => $faker->word,
        'description' => $faker->text,
    ];
});
