<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\PlantApplication::class, function (Faker $faker) {
    $herbariums = \App\Models\Herbarium::all()->pluck('id')->toArray();
    $plant_part_factors = \App\Models\General::where('type', 'part')->pluck('id')->toArray();
    $plant_application_factors = \App\Models\General::where('type', 'application')->pluck('id')->toArray();
    $plant_growth_factors = \App\Models\General::where('type', 'growth')->pluck('id')->toArray();
    $plant_usage_type_factors = \App\Models\General::where('type', 'usage_type')->pluck('id')->toArray();
    $plant_industry_factors = \App\Models\General::where('type', 'industry')->pluck('id')->toArray();

    return [
        'herbarium_id' => $faker->randomElement($herbariums),
        'general_part_id' => $faker->randomElement($plant_part_factors),
        'general_application_id' => $faker->randomElement($plant_application_factors),
        'general_growth_id' => $faker->randomElement($plant_growth_factors),
        'general_usage_type_id' => $faker->randomElement($plant_usage_type_factors),
        'general_industry_id' => $faker->randomElement($plant_industry_factors),
        'presence' => $faker->word,
    ];
});
