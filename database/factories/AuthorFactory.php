<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Author::class, function (Faker $faker) {
    return [
        'name' => make_json($faker->name),
        'user_id' => $faker->randomElement(\App\Models\User::pluck('id')->toArray()),
    ];
});
