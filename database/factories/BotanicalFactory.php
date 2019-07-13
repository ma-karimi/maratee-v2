<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Botanical::class, function (Faker $faker) {
    return [
        'herbarium_id' => $faker->randomNumber(),
        'height' => '2.3',
        'flower_color' => make_json($faker->word),
        'fruit_color' => make_json($faker->word),
        'leaf_color' => make_json($faker->word),
        'sprout' => make_json($faker->word),
        'treatment' => make_json($faker->word),
        'growth_rate' => make_json($faker->word),
        'first_flowering' => make_json($faker->word),
        'flowering_interval' => make_json($faker->word),
        'first_seeding' => make_json($faker->word),
        'seed_value' => make_json($faker->word),
        'seed_production' => make_json($faker->word),
        'season_resistance' => make_json($faker->word),
        'year' => $faker->dateTimeBetween(),
        'sensitivity' => make_json($faker->word),
        'sensitivity_description' => make_json($faker->word),
        'notes' => make_json($faker->word),
        'planting' => $faker->dateTimeBetween(),
        'scion_rooting_per' => $faker->randomNumber(),
        'entry_type' => make_json($faker->word),
    ];
});
