<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\PlantApplication::class, function (Faker $faker) {
    return [
        'herbarium_id' => function () {
            return factory(App\Models\Herbarium::class)->create()->id;
        },
        'plant_factor_part_id' => function () {
            return factory(App\Models\PlantFactor::class)->create(['type'=>'part'])->id;
        },
        'plant_factor_application_id' => function () {
            return factory(App\Models\PlantFactor::class)->create(['type'=>'application'])->id;
        },
        'plant_factor_growth_id' => function () {
            return factory(App\Models\PlantFactor::class)->create(['type'=>'growth'])->id;
        },
        'plant_factor_usage_type_id' => function () {
            return factory(App\Models\PlantFactor::class)->create(['type'=>'usage_type'])->id;
        },
        'plant_factor_industry_id' => function () {
            return factory(App\Models\PlantFactor::class)->create()->id;
        },
        'presence' => $faker->word,
    ];
});
