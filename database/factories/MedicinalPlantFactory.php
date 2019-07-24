<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\PlantFactor;
use Faker\Generator as Faker;

$factory->define(App\Models\MedicinalPlant::class, function (Faker $faker) {
    $origins = \App\Models\PlantFactor::whereType('origin')->pluck('id')->toArray();
    $herbariums = \App\Models\Herbarium::pluck('id')->toArray();
    $locations = \App\Models\Location::pluck('id')->toArray();
    $methods = \App\Models\Method::pluck('id')->toArray();
    $articles = \App\Models\Article::pluck('id')->toArray();
    $soils = \App\Models\Soil::pluck('id')->toArray();
    $medias = \App\Models\Media::pluck('id')->toArray();
    return [
        'plant_origin_id' => $faker->randomElement($origins),
        'code_no' => $faker->numberBetween(1, 100),
        'treatment' => make_json($faker->word),
        'vast_cultivation' => make_json($faker->word),
        'studied_sample' => make_json($faker->word),
        'efficiency' => $faker->randomFloat(),
        'secondary_metabolite' => $faker->word,
        'herbarium_id' => $faker->randomElement($herbariums),
        'location_id' => $faker->randomElement($locations),
        'method_id' => $faker->randomElement($methods),
        'article_id' => $faker->randomElement($articles),
        'exclusivity' => make_json($faker->word),
        'life_cycle' => make_json($faker->word),
        'acidity' => make_json($faker->word),
        'soil_id' => $faker->randomElement($soils),
        'media_id' => $faker->randomElement($medias),
    ];
});
