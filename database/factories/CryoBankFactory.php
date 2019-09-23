<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\CryoBank::class, function (Faker $faker) {
    $locations = \App\Models\Location::pluck('id')->toArray();
    $taxonomies = \App\Models\Taxonomy::pluck('id')->toArray();
    $protections = \App\Models\Protection::pluck('id')->toArray();
    $treatments = \App\Models\Treatment::pluck('id')->toArray();
    return [
        'genotype_code' => $faker->word,
        'sample_type_id' => random_int(0,3),
        'proposal_name' => $faker->word,
        'repeat' => $faker->numberBetween(1, 100),
        'tank' => $faker->numberBetween(1, 100),
        'row' => $faker->numberBetween(1, 100),
        'rack' => $faker->word,
        'cell' => $faker->numberBetween(1, 100),
        'taxonomy_id' => $faker->randomElement($taxonomies),
        'treatment_id' => $faker->randomElement($treatments),
        'protection_id' => $faker->randomElement($protections),
        'location_id' => $faker->randomElement($locations),
        'treatment_values' => $faker->numberBetween(20,40),
    ];
});
