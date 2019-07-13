<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Herbarium::class, function (Faker $faker) {
    return [
        'number' => $faker->randomNumber(),
        'location_id' => $faker->randomNumber(),
        'phenology_id' => $faker->randomNumber(),
        'protection_id' => $faker->randomNumber(),
        'phytogeography_id' => $faker->randomNumber(),
        'organization_id' => $faker->randomNumber(),
        'sheets_no' => $faker->randomNumber(),
        'samples_no' => $faker->randomNumber(),
        'tip_qt' => $faker->randomNumber(),
        'physical_tip_qt' => $faker->randomNumber(),
        'tip_type' => $faker->word,
        'name' => $faker->name,
        'description' => $faker->text,
        'is_flowering' => $faker->randomNumber(),
        'organization_description' => $faker->word,
        'herbarium_tip_location' => $faker->randomNumber(),
        'type_description' => $faker->word,
        'plant_type_id' => $faker->randomNumber(),
        'flowering' => $faker->word,
        'plant_group_id' => $faker->randomNumber(),
    ];
});
