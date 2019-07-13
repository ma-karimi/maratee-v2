<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\SeedChemical::class, function (Faker $faker) {
    return [
        'chemical_id' => function () {
            return factory(App\Models\Chemical::class)->create()->id;
        },
        'seed_id' => function () {
            return factory(App\Models\Seed::class)->create()->id;
        },
        'treatment' => $faker->word,
        'repeat' => $faker->randomNumber(),
        'location_id' => function () {
            return factory(App\Models\Location::class)->create()->id;
        },
    ];
});
