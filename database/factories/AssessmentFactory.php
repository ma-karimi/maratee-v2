<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Assessment::class, function (Faker $faker) {
    return [
        'date' => $faker->dateTimeBetween(),
        'seed_qt' => $faker->randomNumber(),
        'weight_k' => $faker->randomNumber(),
        'purity' => $faker->randomNumber(),
        'hollow' => $faker->randomNumber(),
        'dropped' => $faker->randomNumber(),
        'repeat' => $faker->randomNumber(),
        'treatment' => $faker->word,
        'abnormality' => $faker->randomNumber(),
        'hard_seed' => $faker->randomNumber(),
        'vigor' => $faker->randomNumber(),
        'losses' => $faker->randomNumber(),
        'sprout' => $faker->randomNumber(),
        'sprout_rate' => $faker->randomNumber(),
        'sprout_index' => $faker->randomNumber(),
        'vigor_index' => $faker->randomNumber(),
        'root_length' => $faker->randomNumber(),
        'stem_length' => $faker->randomNumber(),
        'seedling_length' => $faker->randomNumber(),
        'root_stem_rate' => $faker->randomNumber(),
        'wet_uint_weight' => $faker->randomNumber(),
        'dry_unit_weight' => $faker->randomNumber(),
        'dry_material_rate' => $faker->randomNumber(),
        'seed_length' => $faker->randomNumber(),
        'seed_width' => $faker->randomNumber(),
        'description' => $faker->text,
    ];
});
