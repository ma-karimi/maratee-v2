<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\CryoBank::class, function (Faker $faker) {
    $plants = \App\Models\Plant::pluck('id')->toArray();
    $protections = \App\Models\Protection::pluck('id')->toArray();
    return [
        'genotype_code' => $faker->word,
        'sample_type_id' => random_int(0,3),
        'proposal_name' => $faker->word,
        'repeat' => $faker->numberBetween(1, 100),
        'tank' => $faker->numberBetween(1, 100),
        'row' => $faker->numberBetween(1, 100),
        'rack' => $faker->word,
        'cell' => $faker->numberBetween(1, 100),
        'plant_id' => $faker->randomElement($plants),
        'treatment_id' => $faker->randomElement($plants),
        'protection_id' => $faker->randomElement($protections),
        'treatment_values' => $faker->numberBetween(20,40),
    ];
});
