<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Geramin::class, function (Faker $faker) {
    return [
        'collection_id' => function () {
            return factory(App\Models\Collection::class)->create()->id;
        },
        'seed_id' => function () {
            return factory(App\Models\Seed::class)->create()->id;
        },
        'repeat' => $faker->word,
        'bush' => $faker->randomNumber(),
        'average' => $faker->randomNumber(),
        'flowering_completion' => $faker->dateTimeBetween(),
        'gdd_flowering' => $faker->dateTimeBetween(),
        'essence_rate' => $faker->randomNumber(),
        'bush_weight' => $faker->randomNumber(),
        'bush_height' => $faker->randomNumber(),
        'big_bush_diameter' => $faker->randomNumber(),
        'small_bush_diameter' => $faker->randomNumber(),
        'flowering_bish_qt' => $faker->randomNumber(),
        'crown_coverage' => $faker->randomNumber(),
        'flower_color' => $faker->word,
    ];
});
