<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\SeedMolecular::class, function (Faker $faker) {
    return [
        'molecular_id' => function () {
            return factory(App\Models\Molecular::class)->create()->id;
        },
        'seed_id' => function () {
            return factory(App\Models\Seed::class)->create()->id;
        },
        'location_id' => function () {
            return factory(App\Models\Location::class)->create()->id;
        },
        'treatment' => $faker->word,
        'repeat' => $faker->randomNumber(),
    ];
});
