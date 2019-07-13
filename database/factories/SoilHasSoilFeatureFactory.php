<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\SoilHasSoilFeature::class, function (Faker $faker) {
    return [
        'soil_id' => function () {
            return factory(App\Models\Soil::class)->create()->id;
        },
        'soil_feature_id' => function () {
            return factory(App\Models\SoilFeature::class)->create()->id;
        },
        'value' => make_json($faker->word),
    ];
});
