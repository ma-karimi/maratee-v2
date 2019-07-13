<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\SeedTechnology::class, function (Faker $faker) {
    return [
        'seed_id' => function () {
            return factory(App\Models\Seed::class)->create()->id;
        },
        'seed_type' => make_json($faker->word),
        'type' => make_json($faker->word),
        'husk_average' => $faker->randomNumber(),
        'husk_weight' => $faker->randomNumber(),
        'seed_weight' => $faker->randomNumber(),
        'humidity' => $faker->randomNumber(),
        'purity' => $faker->randomNumber(),
        'hard_seed' => $faker->randomNumber(),
        'abnormality' => $faker->randomNumber(),
        'sprout' => $faker->randomNumber(),
        'vigor' => $faker->randomNumber(),
        'examine' => $faker->date(),
        'description' => make_json($faker->text),
    ];
});
