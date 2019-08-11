<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Component::class, function (Faker $faker) {
    return [
        'name' => make_json($faker->word),
        'description' => make_json($faker->text),
    ];
});
