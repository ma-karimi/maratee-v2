<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\SeedTechnology::class, function (Faker $faker) {
    $seeds = \App\Models\Seed::pluck('id')->toArray();
    return [
        'seed_id' => $faker->randomElement($seeds),
        'seed_type' => make_json($faker->word),
        'type' => make_json($faker->word),
        'husk_average' => $faker->numberBetween(1, 100),
        'husk_weight' => $faker->numberBetween(1, 100),
        'seed_weight' => $faker->numberBetween(1, 100),
        'humidity' => $faker->numberBetween(1, 100),
        'purity' => $faker->numberBetween(1, 100),
        'hard_seed' => $faker->numberBetween(1, 100),
        'abnormality' => $faker->numberBetween(1, 100),
        'sprout' => $faker->numberBetween(1, 100),
        'vigor' => $faker->numberBetween(1, 100),
        'examine' => $faker->date(),
        'description' => make_json($faker->text),
    ];
});
