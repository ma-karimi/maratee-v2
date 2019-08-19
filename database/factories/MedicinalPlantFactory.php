<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\General;
use Faker\Generator as Faker;

$factory->define(App\Models\MedicinalPlant::class, function (Faker $faker) {
    $applications = \App\Models\PlantApplication::pluck('id')->toArray();
    return [
        'plant_application_id' => $faker->randomElement($applications),
        'code_no' => $faker->numberBetween(1, 100),
        'cultivated_area' => make_json($faker->word),
        'vast_cultivation' => make_json($faker->randomElement(['raw','processed'])),
        'studied_sample' => make_json($faker->randomElement(['wild','cultivated'])),
        'efficiency' => $faker->randomFloat(),
        'secondary_metabolite' => $faker->word,
        'exclusivity' => make_json($faker->word),
        'life_cycle' => make_json($faker->word),
        'phenology_stage' => make_json($faker->word),
        'used_origin' => make_json($faker->word),
        'used_type' => make_json($faker->word),
    ];
});
