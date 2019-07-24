<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(App\Models\Group::class, function (Faker $faker) {
    return [
        'name' => make_json($faker->name),
        'owner_crud' => make_json($faker->numberBetween(0,1)),
        'same_level_crud' => make_json($faker->numberBetween(0,1)),
        'upper_level_crud' => make_json($faker->numberBetween(0,1)),
        'lower_level_crud' => make_json($faker->numberBetween(0,1)),
        'description' => make_json($faker->name),
    ];
});
