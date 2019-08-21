<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Method::class, function (Faker $faker) {
    $methods = \App\Models\Method::pluck('id')->toArray();
    $parent = $faker->randomElement($methods);

    return [
        'name' => make_json($faker->name),
        'description' => make_json($faker->text),
        'parent_id' =>   ($parent % 2) ? $parent : null,
    ];
});
