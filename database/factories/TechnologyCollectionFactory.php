<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Technology::class, function (Faker $faker) {
    $seed_techs=\App\Models\SeedTechnology::pluck('id')->toArray();
    $collections=\App\Models\Collection::pluck('id')->toArray();
    return [
        'seed_technology_id' => $faker->randomElement($seed_techs),
        'collection_id' => $faker->randomElement($collections),
    ];
});
