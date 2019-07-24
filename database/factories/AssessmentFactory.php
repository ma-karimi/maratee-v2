<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Assessment::class, function (Faker $faker) {
    return [
        'date' => $faker->dateTimeBetween(),
        'seed_qt' => $faker->numberBetween(1, 100),
        'weight_k' => $faker->numberBetween(1, 100),
        'purity' => $faker->numberBetween(1, 100),
        'hollow' => $faker->numberBetween(1, 100),
        'dropped' => $faker->numberBetween(1, 100),
        'repeat' => $faker->numberBetween(1, 100),
        'treatment' => make_json($faker->word),
        'abnormality' => $faker->numberBetween(1, 100),
        'hard_seed' => $faker->numberBetween(1, 100),
        'vigor' => $faker->numberBetween(1, 100),
        'losses' => $faker->numberBetween(1, 100),
        'sprout' => $faker->numberBetween(1, 100),
        'sprout_rate' => $faker->numberBetween(1, 100),
        'sprout_index' => $faker->numberBetween(1, 100),
        'vigor_index' => $faker->numberBetween(1, 100),
        'root_length' => $faker->numberBetween(1, 100),
        'stem_length' => $faker->numberBetween(1, 100),
        'seedling_length' => $faker->numberBetween(1, 100),
        'root_stem_rate' => $faker->numberBetween(1, 100),
        'wet_uint_weight' => $faker->numberBetween(1, 100),
        'dry_unit_weight' => $faker->numberBetween(1, 100),
        'dry_material_rate' => $faker->numberBetween(1, 100),
        'seed_length' => $faker->numberBetween(1, 100),
        'seed_width' => $faker->numberBetween(1, 100),
        'description' => make_json($faker->text),
    ];
});
