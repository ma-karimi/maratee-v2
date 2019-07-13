<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\SeedMolecular::class, function (Faker $faker) {
    $moleculars=\App\Models\Molecular::pluck('id')->toArray();
    $seeds=\App\Models\Seed::pluck('id')->toArray();
    $locations=\App\Models\Location::pluck('id')->toArray();
    return [
        'molecular_id' =>$faker->randomElement($moleculars),
        'seed_id' => $faker->randomElement($seeds),
        'location_id' => $faker->randomElement($locations),
        'treatment' => make_json($faker->word),
        'repeat' => $faker->randomNumber(),
    ];
});
