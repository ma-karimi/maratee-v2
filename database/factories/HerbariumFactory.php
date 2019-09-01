<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Herbarium;
use Faker\Generator as Faker;

$factory->define(App\Models\Herbarium::class, function (Faker $faker) {
    $phenologies = \App\Models\General::whereType('phenology')->pluck('id')->toArray();
    $phytogeographies = \App\Models\General::whereType('phytogeography')->pluck('id')->toArray();
    $protections = \App\Models\Protection::pluck('id')->toArray();
    $plant_groups = \App\Models\General::whereType('group')->pluck('id')->toArray();
    $organizations = \App\Models\Organization::pluck('id')->toArray();
    $divisions = \App\Models\Division::pluck('id')->toArray();
    $plant_types = \App\Models\General::whereType('plant_type')->pluck('id')->toArray();
    $habitats = \App\Models\General::whereType('habitat')->pluck('id')->toArray();
    $plants = \App\Models\Plant::pluck('id')->toArray();
    $cycles = \App\Models\LifeForm::whereType('life_cycle')->pluck('id')->toArray();
    $leafs = \App\Models\LifeForm::whereType('leaf')->pluck('id')->toArray();
    $woodens = \App\Models\LifeForm::whereType('wooden')->pluck('id')->toArray();
    $herbaceouses = \App\Models\LifeForm::whereType('herbaceous')->pluck('id')->toArray();
    return [
        'number' => $faker->numberBetween(1, 100),
        'general_phenology_id' => $faker->randomElement($phenologies),
        'protection_id' => $faker->randomElement($protections),
        'general_phytogeography_id' => $faker->randomElement($phytogeographies),
        'organization_id' => $faker->randomElement($organizations),
        'sheets_no' => $faker->numberBetween(1, 100),
        'growth_rate' => $faker->randomElement(Herbarium::GROWTH_RATES),
        'samples_no' => $faker->numberBetween(1, 100),
        'tip_qt' => $faker->numberBetween(1, 100),
        'physical_tip_qt' => $faker->numberBetween(1, 100),
//        'tip_type' => $faker->word,
        'description' => make_json($faker->text),
        'is_flowering' => $faker->numberBetween(0, 1),
//        'organization_description' => $faker->word,
//        'herbarium_tip_location' => $faker->numberBetween(1, 100),
        'general_group_id' => $faker->randomElement($plant_groups),
        'general_habitat_id' => $faker->randomElement($habitats),
        'plant_id' => $faker->randomElement($plants),
        'life_forms' => ['leaf_id' => $faker->randomElement($leafs),'cycle_id' => $faker->randomElement($cycles), 'wooden_id' => $faker->randomElement($woodens), 'herbaceous_id' => $faker->randomElement($herbaceouses)],
    ];
});
