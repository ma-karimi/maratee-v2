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
        'bush' => $faker->numberBetween(1, 100),
        'average' => $faker->numberBetween(1, 100),
        'flowering_completion' => $faker->dateTimeBetween(),
        'gdd_flowering' => $faker->dateTimeBetween(),
        'essence_rate' => $faker->numberBetween(1, 100),
        'bush_weight' => $faker->numberBetween(1, 100),
        'bush_height' => $faker->numberBetween(1, 100),
        'big_bush_diameter' => $faker->numberBetween(1, 100),
        'small_bush_diameter' => $faker->numberBetween(1, 100),
        'flowering_bish_qt' => $faker->numberBetween(1, 100),
        'crown_coverage' => $faker->numberBetween(1, 100),
        'flower_color' => make_json($faker->word),
    ];
});
