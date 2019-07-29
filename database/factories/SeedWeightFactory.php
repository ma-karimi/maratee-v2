<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\SeedWeight::class, function (Faker $faker) {
    $seed_technologies = \App\Models\SeedTechnology::pluck('id')->toArray();
    return [
        'seed_technology_id' => $faker->randomElement($seed_technologies),
        'total' => $faker->numberBetween(1, 100),
        'active' => $faker->numberBetween(1, 100),
        'base' => $faker->numberBetween(1, 100),
        'support' => $faker->numberBetween(1, 100),
        'base_revival' => $faker->numberBetween(1, 100),
        'active_revival' => $faker->numberBetween(1, 100),
        'support_revival' => $faker->numberBetween(1, 100),
        'revival_code' => $faker->word,
        'description' => make_json($faker->text),
    ];
});
