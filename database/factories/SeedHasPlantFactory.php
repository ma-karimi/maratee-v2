<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\SeedHasPlant::class, function (Faker $faker) {
    return [
        'seed_id' => function () {
            return factory(App\Models\Seed::class)->create()->id;
        },
        'plant_id' => function () {
            return factory(App\Models\Plant::class)->create()->id;
        },
    ];
});
