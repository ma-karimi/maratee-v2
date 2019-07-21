<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Role::class, function (Faker $faker) {

    return [
        'name' => make_json($faker->name),
        'level' => $faker->numberBetween(0,1),
        'description' => make_json($faker->sentence),
    ];
});
