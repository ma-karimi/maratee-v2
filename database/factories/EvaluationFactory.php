<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Evaluation::class, function (Faker $faker) {

    return [
        'date' => $faker->dateTime(),
        'exchange_seeds_no' => $faker->numberBetween(1,100),
        'planted_seeds_no' => $faker->numberBetween(1,100),
        'fresh_none_germinated_seeds' => $faker->numberBetween(1,100),
        'rotten_seeds' => $faker->numberBetween(1,100),
        'abnormal_seedling' => $faker->numberBetween(1,100),
        'seedling_morality_no' => $faker->numberBetween(1,100),
        'viability_percentage' => $faker->numberBetween(1,100),
        'mean_fresh_seedling_weight' => $faker->numberBetween(1,100),
        'mean_dry_seedling_weight' => $faker->numberBetween(1,100),
        'dry_matter_percentage' => $faker->numberBetween(1,100),
        'description' => make_json($faker->text),
    ];

});
