<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Continent::class, function (Faker $faker) {
    $continents = \App\Models\Continent::pluck('id')->toArray();
    $parent = $faker->randomElement($continents);

    return [
        'name' => make_json($faker->name),
        'parent_id' =>   ($parent % 2) ? $parent : null,
    ];
});
