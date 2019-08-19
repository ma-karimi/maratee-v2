<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\BioMolecular::class, function (Faker $faker) {
    $seed_features = \App\Models\SeedFeature::pluck('id')->toArray();
    $blocks = \App\Models\Block::pluck('id')->toArray();
    $technologies = \App\Models\Technology::pluck('id')->toArray();
    return [
        'block_id' => $faker->randomElement($blocks),
        'technology_id' => $faker->randomElement($technologies),
        'seed_feature_id' => $faker->randomElement($seed_features),
        'repeat' => $faker->numberBetween(1, 100),
        'value' =>$faker->word,
    ];
});
