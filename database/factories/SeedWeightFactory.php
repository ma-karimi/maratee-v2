<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\SeedWeight::class, function (Faker $faker) {
    return [
        'seed_technology_id' => function () {
            return factory(App\Models\SeedTechnology::class)->create()->id;
        },
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
