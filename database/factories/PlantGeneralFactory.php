<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\PlantGeneral::class, function (Faker $faker) {
    return [
        'name' => make_json($faker->name),
        'description' => make_json($faker->text),
        'type' => $faker->word,
        'parent_id' => $faker->randomNumber(),
    ];
});
