<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Herbarium::class, function (Faker $faker) {
    $locations = \App\Models\Location::pluck('id')->toArray();
    $phenologies = \App\Models\Plantology::whereType('phenology')->pluck('id')->toArray();
    $phytogeographies = \App\Models\Plantology::whereType('phytogeography')->pluck('id')->toArray();
    $protections = \App\Models\Protection::pluck('id')->toArray();
    $plant_groups = \App\Models\PlantGeneral::whereType('group')->pluck('id')->toArray();
    $organizations = \App\Models\Organization::pluck('id')->toArray();
    $plant_types = \App\Models\PlantGeneral::whereType('plant_type')->pluck('id')->toArray();
    return [
        'number' => $faker->randomNumber(),
        'location_id' => $faker->randomElement($locations),
        'phenology_id' => $faker->randomElement($phenologies),
        'protection_id' => $faker->randomElement($protections),
        'phytogeography_id' => $faker->randomElement($phytogeographies),
        'organization_id' => $faker->randomElement($organizations),
        'sheets_no' => $faker->randomNumber(),
        'samples_no' => $faker->randomNumber(),
        'tip_qt' => $faker->randomNumber(),
        'physical_tip_qt' => $faker->randomNumber(),
        'tip_type' => $faker->word,
        'name' => make_json($faker->name),
        'description' => make_json($faker->text),
        'is_flowering' => $faker->randomNumber(),
        'organization_description' => $faker->word,
        'herbarium_tip_location' => $faker->randomNumber(),
        'type_description' => $faker->word,
        'plant_type_id' => $faker->randomElement($plant_types),
        'flowering' => $faker->word,
        'plant_group_id' => $faker->randomElement($plant_groups),
    ];
});
