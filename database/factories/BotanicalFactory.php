<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Botanical::class, function (Faker $faker) {
    return [
        'herbarium_id' => $faker->randomNumber(),
        'height' => $faker->randomFloat(),
        'flower_color' => $faker->word,
        'fruit_color' => $faker->word,
        'leaf_color' => $faker->word,
        'sprout' => $faker->word,
        'treatment' => $faker->word,
        'growth_rate' => $faker->word,
        'first_flowering' => $faker->word,
        'flowring_interval' => $faker->word,
        'first_seeding' => $faker->word,
        'seed_value' => $faker->word,
        'seed_production' => $faker->word,
        'season_resistance' => $faker->word,
        'year' => $faker->dateTimeBetween(),
        'sensitivity' => $faker->word,
        'sensitivity_description' => $faker->word,
        'notes' => $faker->word,
        'planting' => $faker->dateTimeBetween(),
        'scion_rooting_per' => $faker->randomNumber(),
        'entry_type' => $faker->word,
    ];
});
