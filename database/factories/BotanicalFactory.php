<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Botanical;
use Faker\Generator as Faker;

$factory->define(App\Models\Botanical::class, function (Faker $faker) {
    $plants = \App\Models\PlantHerbarium::pluck('id')->toArray();
    $habitats = \App\Models\General::whereType('habitat')->pluck('id')->toArray();
    $soils = \App\Models\Soil::pluck('id')->toArray();
    return [
        'plant_id' => $faker->randomElement($plants),
        'height' => 2,
        'flower_color' => make_json($faker->word),
        'fruit_color' => make_json($faker->word),
        'foliage_color' => make_json($faker->word),
        'seed_germination' => make_json($faker->word),
        'planting' => $faker->dateTimeBetween(),
        'cutting_rooting' => $faker->numberBetween(1, 100),
        'treatment' => make_json($faker->word),
        'growth_rate' => $faker->randomElement(array_keys(Botanical::GROWTH_RATES)),
        'first_flowering' => $faker->date(),
        'first_seeding' => $faker->date(),
        'seed_formation'=>$faker->randomElement(array_keys(Botanical::SEED_FORMATION)),
        'winter_tolerance'=>$faker->randomElement(array_keys(Botanical::WINTER_TOLERANCE)),
        'summer_tolerance'=>$faker->randomElement(array_keys(Botanical::SUMMER_TOLERANCE)),
        'seed_rate' => $faker->randomElement(array_keys(Botanical::SEED_RATE)),
        'comments' => make_json($faker->word),
        'garden_map' => make_json($faker->word),
        'garden_name' => make_json($faker->word),
        'general_habitat_id' => $faker->randomElement($habitats),
        'entrance_to_garden' => $faker->randomElement(array_keys(Botanical::ENTRANCE_TO_GARDEN)),
        'soil_id' => $faker->randomElement($soils)
    ];
});
