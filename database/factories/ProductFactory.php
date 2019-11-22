<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => make_json($faker->name),
        'registration_status' => array_rand(\App\Models\Product::STATUS),
        'components' => $faker->text,
        'manufacturer' => $faker->text,
        'active_compounds' => $faker->text,
    ];
});
