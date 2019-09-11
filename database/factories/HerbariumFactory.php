<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Herbarium;
use Faker\Generator as Faker;

$factory->define(App\Models\Herbarium::class, function (Faker $faker) {
    $plants = \App\Models\Plant::pluck('id')->toArray();
    $organizations = \App\Models\Organization::pluck('id')->toArray();

    return [
        'number' => $faker->numberBetween(1, 100),
        'organization_id' => $faker->randomElement($organizations),
        'sheets_no' => $faker->numberBetween(1, 100),
        'samples_no' => $faker->numberBetween(1, 100),
        'tip_qt' => $faker->numberBetween(1, 100),
        'physical_tip_qt' => $faker->numberBetween(1, 100),
        'description' => make_json($faker->text),
        'plant_id' => $faker->randomElement($plants),
    ];
});
