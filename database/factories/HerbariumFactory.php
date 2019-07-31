<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Herbarium::class, function (Faker $faker) {
    $locations = \App\Models\Location::pluck('id')->toArray();
    $phenologies = \App\Models\General::whereType('phenology')->pluck('id')->toArray();
    $phytogeographies = \App\Models\General::whereType('phytogeography')->pluck('id')->toArray();
    $protections = \App\Models\Protection::pluck('id')->toArray();
    $plant_groups = \App\Models\General::whereType('group')->pluck('id')->toArray();
    $organizations = \App\Models\Organization::pluck('id')->toArray();
    $plant_types = \App\Models\General::whereType('plant_type')->pluck('id')->toArray();
    $plants = \App\Models\Plant::pluck('id')->toArray();
    return [
        'number' => $faker->numberBetween(1, 100),
        'location_id' => $faker->randomElement($locations),
        'general_phenology_id' => $faker->randomElement($phenologies),
        'protection_id' => $faker->randomElement($protections),
        'general_phytogeography_id' => $faker->randomElement($phytogeographies),
        'organization_id' => $faker->randomElement($organizations),
        'sheets_no' => $faker->numberBetween(1, 100),
        'samples_no' => $faker->numberBetween(1, 100),
        'tip_qt' => $faker->numberBetween(1, 100),
        'physical_tip_qt' => $faker->numberBetween(1, 100),
        'tip_type' => $faker->word,
        'name' => make_json($faker->name),
        'description' => make_json($faker->text),
        'is_flowering' => $faker->numberBetween(0, 1),
        'organization_description' => $faker->word,
        'herbarium_tip_location' => $faker->numberBetween(1, 100),
        'type_description' => $faker->word,
        'general_type_id' => $faker->randomElement($plant_types),
        'flowering' => $faker->word,
        'general_group_id' => $faker->randomElement($plant_groups),
        'plant_id' => $faker->randomElement($plants),
    ];
});
