<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Botanical;
use Faker\Generator as Faker;

$factory->define(App\Models\Botanical::class, function (Faker $faker) {
    $plants = \App\Models\Taxonomy::pluck('id')->toArray();
    $habitats = \App\Models\General::whereType('habitat')->pluck('id')->toArray();
    $origins = \App\Models\General::whereType('origin')->pluck('id')->toArray();
    $soils = \App\Models\Soil::pluck('id')->toArray();
    $protections = \App\Models\Protection::pluck('id')->toArray();
    $gardens = \App\Models\Garden::pluck('id')->toArray();
    return [
        'taxonomy_id' => $faker->randomElement($plants),
        'height' => 2,
        'monopoly_of_iran_id'=>$faker->numberBetween(0,1),
        'wooden_id'=>$faker->numberBetween(1,2),
        'cycle_id'=>$faker->numberBetween(1,12),
        'entrance_to_garden_id'=>$faker->numberBetween(1,12),
        'garden_id'=>$faker->randomElement($gardens),
        'protection_id'=>$faker->randomElement($protections),
        'flower_color' => $faker->word,
        'fruit_color' => $faker->word,
        'foliage_color' => $faker->word,
        'seed_germination_id' => $faker->numberBetween(1,4),
        'planting' => $faker->dateTimeBetween(),
        'cutting_rooting' => $faker->numberBetween(1, 99),
        'treatment' => $faker->word,
        'growth_rate_id' => $faker->randomElement(array_keys(Botanical::GROWTH_RATES)),
        'first_flowering' => $faker->date(),
        'first_seeding' => $faker->date(),
        'seed_formation_id'=>$faker->randomElement(array_keys(Botanical::SEED_FORMATION)),
        'winter_tolerance_id'=>$faker->randomElement(array_keys(Botanical::WINTER_TOLERANCE)),
        'summer_tolerance_id'=>$faker->randomElement(array_keys(Botanical::SUMMER_TOLERANCE)),
        'seed_rate_id' => $faker->randomElement(array_keys(Botanical::SEED_RATE)),
        'comments' => $faker->word,
        'garden_map' => $faker->word,
        'general_habitat_id' => $faker->randomElement($habitats),
        'general_origin_id' => $faker->randomElement($origins),
        'entrance_to_garden_id' => $faker->randomElement(array_keys(Botanical::ENTRANCE_TO_GARDEN)),
        'soil_id' => $faker->numberBetween(1,4)
    ];
});
