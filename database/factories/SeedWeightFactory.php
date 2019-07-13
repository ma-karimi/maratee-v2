<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\SeedWeight::class, function (Faker $faker) {
    $seed_technologies = \App\Models\SeedTechnology::pluck('id')->toArray();
    return [
        'seed_technology_id' => $faker->randomElement($seed_technologies),
        'total' => $faker->randomNumber(),
        'active' => $faker->randomNumber(),
        'base' => $faker->randomNumber(),
        'support' => $faker->randomNumber(),
        'base_revival' => $faker->randomNumber(),
        'active_revival' => $faker->randomNumber(),
        'support_revival' => $faker->randomNumber(),
        'revival_code' => $faker->word,
        'description' => make_json($faker->text),
    ];
});
