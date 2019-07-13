<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Medical::class, function (Faker $faker) {
    return [
        'herbarium_id' => function () {
            return factory(App\Models\Herbarium::class)->create()->id;
        },
        'medicine_side_effect_id' => function () {
            return factory(App\Models\Medicine::class)->create()->id;
        },
        'side_effect_description' => make_json($faker->word),
        'medicine_effect_id' => function () {
            return factory(App\Models\Medicine::class)->create()->id;
        },
        'medicine_effect_description' => make_json($faker->word),
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
        'medicine_drug_shape_id' => function () {
            return factory(App\Models\Medicine::class)->create()->id;
        },
        'drug_shape_description' => make_json($faker->word),
        'medicine_medicinal_part_id' => function () {
            return factory(App\Models\Medicine::class)->create()->id;
        },
        'medicinal_part_description' => make_json($faker->word),
        'medicine_drug_usage_id' => function () {
            return factory(App\Models\Medicine::class)->create()->id;
        },
        'drug_usage_description' => make_json($faker->word),
    ];
});
