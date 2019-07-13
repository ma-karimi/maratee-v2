<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Seed::class, function (Faker $faker) {
    $herbariums = \App\Models\Herbarium::pluck('id')->toArray();
    $protections = \App\Models\Protection::pluck('id')->toArray();
    $departments = \App\Models\Department::pluck('id')->toArray();
    return [
        'herbarium_id' => $faker->randomElement($herbariums),
        'protection_id' => $faker->randomElement($protections),
        'field_code' => $faker->randomNumber(),
        'correct_field_code' => $faker->word,
        'sample_code' => $faker->randomNumber(),
        'voucher_no' => $faker->randomNumber(),
        'transmittance' => make_json($faker->word),
        'land_form' => make_json($faker->word),
        'slope_direction' => make_json($faker->word),
        'landscape' => make_json($faker->word),
        'slope_degree' => $faker->randomNumber(),
        'soil_depth' => make_json($faker->word),
        'density' => make_json($faker->word),
        'drainage' => make_json($faker->word),
        'soil_ph' => make_json($faker->word),
        'salinity' => make_json($faker->word),
        'lime' => make_json($faker->word),
        'climate' => make_json($faker->word),
        'extent_population' => make_json($faker->word),
        'vegetation' => make_json($faker->word),
        'soil_erosion' => make_json($faker->word),
        'land_reforming' => make_json($faker->word),
        'sample_type' => make_json($faker->word),
        'flowering' => make_json($faker->word),
        'pollination' => make_json($faker->word),
        'pollination_agent' => make_json($faker->word),
        'fruit_type' => make_json($faker->word),
        'seeding_bush_qt' => $faker->randomNumber(),
        'collecting_type' => make_json($faker->word),
        'seeding_month' => make_json($faker->word),
        'reproduction' => make_json($faker->word),
        'vegetative_form' => make_json($faker->word),
        'height' => $faker->randomNumber(),
        'mother_health' => make_json($faker->word),
        'department_id' => $faker->randomElement($departments),
        'send_date' => $faker->date(),
        'collected_qt' => $faker->randomNumber(),
        'must_collected_qt' => $faker->randomNumber(),
        'critical_extensions_qt' => $faker->randomNumber(),
        'notes' => make_json($faker->word),
    ];
});
