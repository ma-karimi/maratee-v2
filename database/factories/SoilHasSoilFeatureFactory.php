<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\SoilHasSoilFeature::class, function (Faker $faker) {
    $soils=\App\Models\Soil::pluck('id')->toArray();
    $soil_features=\App\Models\SoilFeature::pluck('id')->toArray();
    return [
        'soil_id' => $faker->randomElement($soils),
        'soil_feature_id' =>$faker->randomElement($soil_features),
        'value' => make_json($faker->word),
    ];
});
