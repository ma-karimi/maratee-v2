<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Entry::class, function (Faker $faker) {
    return [
        'type' => make_json($faker->word),
        'description' => make_json($faker->text),
    ];
});
