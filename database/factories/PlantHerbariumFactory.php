<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\PlantHerbarium::class, function (Faker $faker) {
    $organizations = \App\Models\Organization::pluck('id')->toArray();

    $taxonomies = \App\Models\Taxonomy::pluck('id')->toArray();
    $phytogeographies = \App\Models\General::whereType('phytogeography')->pluck('id')->toArray();
    $locations = \App\Models\Location::pluck('id')->toArray();
    $protections = \App\Models\Protection::pluck('id')->toArray();
    $habitats = \App\Models\General::whereType('habitat')->pluck('id')->toArray();
    $cycles = \App\Models\LifeForm::whereType('life_cycle')->pluck('id')->toArray();
    $leafs = \App\Models\LifeForm::whereType('leaf')->pluck('id')->toArray();
    $woodens = \App\Models\LifeForm::whereType('wooden')->pluck('id')->toArray();
    $herbaceouses = \App\Models\LifeForm::whereType('herbaceous')->pluck('id')->toArray();
    $lichens = \App\Models\General::whereType('lichen')->pluck('id')->toArray();
    $diatoms = \App\Models\General::whereType('diatom')->pluck('id')->toArray();
    $mosses = \App\Models\General::whereType('moss')->pluck('id')->toArray();
    $ecology = \App\Models\General::whereType('ecology')->pluck('id')->toArray();
    $plant_type_generals = \App\Models\General::where('type', 'plant_type')->pluck('id')->toArray();

    return [
        'name' => make_json($faker->word),
        'description' => make_json($faker->text),
        'ecology_description' => make_json($faker->text),
        'habitat_description' => make_json($faker->text),
        'general_habitat_id' => $faker->randomElement($habitats),
        'life_forms' => ['leaf_id' => $faker->randomElement($leafs), 'cycle_id' => $faker->randomElement($cycles), 'wooden_id' => $faker->randomElement($woodens), 'herbaceous_id' => $faker->randomElement($herbaceouses)],
        'general_substrate_lichen_id'=>$faker->randomElement($lichens),
        'general_substrate_moss_id'=>$faker->randomElement($mosses),
        'general_substrate_diatom_id'=>$faker->randomElement($diatoms),
        'protection_id' => $faker->randomElement($protections),
        'general_phytogeography_id' => $faker->randomElement($phytogeographies),
        'general_ecology_id' => $faker->randomElement($ecology),
        'is_flowering' => $is_flower = $faker->numberBetween(0, 1),
        'flowering_time' => $is_flower == 1 ? $faker->numberBetween(1, 12) : null,
        'taxonomy_id'=>$faker->randomElement($taxonomies),
        'herbarium_number' => $faker->numberBetween(1, 100),
        'organization_id' => $faker->randomElement($organizations),
        'sheets_no' => $faker->numberBetween(1, 100),
        'samples_no' => $faker->numberBetween(1, 100),
        'tip_qt' => $faker->numberBetween(1, 100),
        'physical_tip_qt' => $faker->numberBetween(1, 100),
        'location_id' => $faker->randomElement($locations),
        'herbarium_index' => $faker->randomElement(['a', 'b', 'c', null])
    ];
});
