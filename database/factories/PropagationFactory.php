<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Propagation::class, function (Faker $faker) {
    return [
        'method' => make_json($faker->name),
        'description' => make_json($faker->text),
    ];
});
