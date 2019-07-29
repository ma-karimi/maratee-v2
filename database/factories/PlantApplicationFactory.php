<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\PlantApplication::class, function (Faker $faker) {
    $herbariums=\App\Models\Herbarium::all()->pluck('id')->toArray();
    $plant_part_factors=\App\Models\PlantFactor::where('type','part')->pluck('id')->toArray();
    $plant_application_factors=\App\Models\PlantFactor::where('type','application')->pluck('id')->toArray();
    $plant_growth_factors=\App\Models\PlantFactor::where('type','growth')->pluck('id')->toArray();
    $plant_usage_type_factors=\App\Models\PlantFactor::where('type','usage_type')->pluck('id')->toArray();
    $plant_industry_factors=\App\Models\PlantFactor::where('type','industry')->pluck('id')->toArray();

    return [
        'herbarium_id' => $faker->randomElement($herbariums),
        'plant_factor_part_id' => $faker->randomElement($plant_part_factors),
        'plant_factor_application_id' =>$faker->randomElement($plant_application_factors),
        'plant_factor_growth_id' => $faker->randomElement($plant_growth_factors),
        'plant_factor_usage_type_id' => $faker->randomElement($plant_usage_type_factors),
        'plant_factor_industry_id' => $faker->randomElement($plant_industry_factors),
        'presence' => $faker->word,
    ];
});
