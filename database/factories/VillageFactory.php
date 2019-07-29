<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Village::class, function (Faker $faker) {
    return [
        'name' => make_json($faker->name),
    ];
});
