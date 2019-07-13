<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Plant::class, function (Faker $faker) {
    return [
        'name' => make_json($faker->word),
        'domestic_name' => make_json($faker->word),
        'description' => make_json($faker->text),
        'author_id' => function () {
            return factory(App\Models\Author::class)->create()->id;
        },
        'article_id' => function () {
            return factory(App\Models\Article::class)->create()->id;
        },
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'location' => function () {
            return factory(App\Models\Location::class)->create()->id;
        },
        'plant_general_class_id' => function () {
            return factory(App\Models\PlantGeneral::class)->create(['type' => 'class'])->id;
        },
        'plant_general_family_id' => function () {
            return factory(App\Models\PlantGeneral::class)->create(['type' => 'family'])->id;
        },
        'plant_general_flowering_id' => function () {
            return factory(App\Models\PlantGeneral::class)->create(['type' => 'flowering'])->id;
        },
        'plant_general_genus_id' => function () {
            return factory(App\Models\PlantGeneral::class)->create(['type' => 'genus'])->id;
        },
        'plant_general_group_id' => function () {
            return factory(App\Models\PlantGeneral::class)->create(['type' => 'group'])->id;
        },
        'plant_general_order_id' => function () {
            return factory(App\Models\PlantGeneral::class)->create(['type' => 'order'])->id;
        },
        'plant_general_specie_id' => function () {
            return factory(App\Models\PlantGeneral::class)->create(['type' => 'specie'])->id;
        },
        'plant_general_sperm_id' => function () {
            return factory(App\Models\PlantGeneral::class)->create(['type' => 'sperm'])->id;
        },
        'plant_general_sub_specie_id' => function () {
            return factory(App\Models\PlantGeneral::class)->create(['type' => 'sub_specie'])->id;
        },
        'plant_general_variety_id' => function () {
            return factory(App\Models\PlantGeneral::class)->create(['type' => 'variety'])->id;
        },
    ];
});
