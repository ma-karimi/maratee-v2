<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\BotanicalGardenAction::class, function (Faker $faker) {
    return [
        'botanical_id' => function () {
            return factory(App\Models\Botanical::class)->create()->id;
        },
        'planting_action_id' => function () {
            return factory(App\Models\PlantingAction::class)->create()->id;
        },
        'date' => $faker->dateTimeBetween(),
        'from_soil_id' => function () {
            return factory(App\Models\Soil::class)->create()->id;
        },
        'to_soil_id' => function () {
            return factory(App\Models\Soil::class)->create()->id;
        },
        'from_lighting_id' => function () {
            return factory(App\Models\Lighting::class)->create()->id;
        },
        'to_lighting_id' => function () {
            return factory(App\Models\Lighting::class)->create()->id;
        },
        'from_garden_id' => function () {
            return factory(App\Models\Garden::class)->create()->id;
        },
        'to_garden_id' => function () {
            return factory(App\Models\Garden::class)->create()->id;
        },
        'initial_place_type' => make_json($faker->word),
        'destination_place_type' => make_json($faker->word),
        'initial_place_condition' => make_json($faker->word),
        'destination_place_condition' => make_json($faker->word),
        'treatment' => make_json($faker->word),
    ];
});
