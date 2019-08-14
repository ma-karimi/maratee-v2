<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\BioMolecular::class, function (Faker $faker) {
    $seeds = \App\Models\Seed::pluck('id')->toArray();
    $chemicals = \App\Models\Chemical::pluck('id')->toArray();
    $locations = \App\Models\Location::pluck('id')->toArray();
    return [
        'chemical_id' => $faker->randomElement($chemicals),
        'seed_id' => $faker->randomElement($seeds),
        'treatment' => make_json($faker->word),
        'repeat' => $faker->numberBetween(1, 100),
        'location_id' =>$faker->randomElement($locations),
    ];
});
