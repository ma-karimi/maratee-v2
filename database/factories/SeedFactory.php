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
        'field_code' => $faker->numberBetween(1, 100),
        'correct_field_code' => $faker->word,
        'sample_code' => $faker->numberBetween(1, 100),
        'voucher_no' => $faker->numberBetween(1, 100),
        'transmittance' => make_json($faker->word),
        'land_form' => make_json($faker->word),
        'slope_direction' => make_json($faker->word),
        'landscape' => make_json($faker->word),
        'slope_degree' => $faker->numberBetween(1, 100),
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
        'seeding_bush_qt' => $faker->numberBetween(1, 100),
        'collecting_type' => make_json($faker->word),
        'seeding_month' => make_json($faker->word),
        'reproduction' => make_json($faker->word),
        'vegetative_form' => make_json($faker->word),
        'height' => $faker->numberBetween(1, 100),
        'mother_health' => make_json($faker->word),
        'department_id' => $faker->randomElement($departments),
        'send_date' => $faker->date(),
        'collected_qt' => $faker->numberBetween(1, 100),
        'must_collected_qt' => $faker->numberBetween(1, 100),
        'critical_extensions_qt' => $faker->numberBetween(1, 100),
        'notes' => make_json($faker->word),
    ];
});
