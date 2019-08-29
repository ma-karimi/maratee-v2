<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\PlantApplication::class, function (Faker $faker) {
    $herbariums = \App\Models\Herbarium::all()->pluck('id')->toArray();
    $plant_part_factors = \App\Models\General::where('type', 'part')->pluck('id')->toArray();
    $general_ecologies = \App\Models\General::where('type', 'ecology')->pluck('id')->toArray();
    $general_habitats = \App\Models\General::where('type', 'habitat')->pluck('id')->toArray();
    $general_origins = \App\Models\General::where('type', 'origin')->pluck('id')->toArray();
    $herbarium_application_factors = \App\Models\General::where('type', 'application')->pluck('id')->toArray();
    $plant_growth_factors = \App\Models\General::where('type', 'growth')->pluck('id')->toArray();
    $plant_usage_type_factors = \App\Models\General::where('type', 'usage_type')->pluck('id')->toArray();
    $plant_industry_factors = \App\Models\General::where('type', 'industry')->pluck('id')->toArray();

    return [
        'herbarium_id' => $faker->randomElement($herbariums),
        'general_part_id' => $faker->randomElement($plant_part_factors),
        'general_application_id' => $faker->randomElement($herbarium_application_factors),
        'general_growth_id' => $faker->randomElement($plant_growth_factors),
        'general_usage_type_id' => $faker->randomElement($plant_usage_type_factors),
        'general_industry_id' => $faker->randomElement($plant_industry_factors),
        'general_ecology_id' => $faker->randomElement($general_ecologies),
        'general_habitat_id' => $faker->randomElement($general_habitats),
        'general_origin_id' => $faker->randomElement($general_origins),
        'presence' => $faker->word,
        'habitat_description' => make_json($faker->word),
        'ecology_description' => make_json($faker->word),
    ];
});
