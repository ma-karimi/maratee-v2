<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\MedicinalPlant::class, function (Faker $faker) {
    return [
        'plant_origin_id' => function () {
            return factory(App\Models\PlantFactor::class)->create()->id;
        },
        'code_no' => $faker->randomNumber(),
        'treatment' => $faker->word,
        'vast_cultivation' => $faker->word,
        'studied_sample' => $faker->word,
        'efficiency' => $faker->randomFloat(),
        'secondary_metabolite' => $faker->word,
        'herbarium_id' => function () {
            return factory(App\Models\Herbarium::class)->create()->id;
        },
        'location_id' => function () {
            return factory(App\Models\Location::class)->create()->id;
        },
        'method_id' => function () {
            return factory(App\Models\Method::class)->create()->id;
        },
        'article_id' => function () {
            return factory(App\Models\Article::class)->create()->id;
        },
        'exclusivity' => $faker->word,
        'life_cycle' => $faker->word,
        'acidity' => $faker->word,
        'soil_id' => function () {
            return factory(App\Models\Soil::class)->create()->id;
        },
        'media_id' => function () {
            return factory(App\Models\Media::class)->create()->id;
        },
    ];
});
