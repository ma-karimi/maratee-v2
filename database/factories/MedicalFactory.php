<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Medical::class, function (Faker $faker) {
    return [
        'medicine_side_effect_id' => function () {
            return factory(App\Models\Medicine::class)->create()->id;
        },
        'side_effect_description' => make_json($faker->word),
        'medicine_effect_id' => function () {
            return factory(App\Models\Medicine::class)->create()->id;
        },
        'effect_description' => make_json($faker->word),
        'medicine_therapy_id' => function () {
            return factory(App\Models\Medicine::class)->create()->id;
        },
        'therapy_description' => make_json($faker->word),
        'medicine_drug_id' => function () {
            return factory(App\Models\Medicine::class)->create()->id;
        },
        'drug_description' => make_json($faker->word),
        'product_id' => function () {
            return factory(App\Models\Product::class)->create()->id;
        },
        'medicine_shape_id' => function () {
            return factory(App\Models\Medicine::class)->create()->id;
        },
        'shape_description' => make_json($faker->word),
        'medicine_part_id' => function () {
            return factory(App\Models\Medicine::class)->create()->id;
        },
        'part_description' => make_json($faker->word),
        'medicine_usage_id' => function () {
            return factory(App\Models\Medicine::class)->create()->id;
        },
        'usage_description' => make_json($faker->word),
        'herbarium_application_id' => function () {
            return factory(App\Models\PlantApplication::class)->create()->id;
        },
    ];
});
