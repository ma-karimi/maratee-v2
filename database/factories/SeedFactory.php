<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Seed::class, function (Faker $faker) {
    return [
        'herbarium_id' => function () {
            return factory(App\Models\Herbarium::class)->create()->id;
        },
        'protection_id' => function () {
            return factory(App\Models\Protection::class)->create()->id;
        },
        'field_code' => $faker->randomNumber(),
        'correct_field_code' => $faker->word,
        'sample_code' => $faker->randomNumber(),
        'voucher_no' => $faker->randomNumber(),
        'transmittance' => $faker->word,
        'land_form' => $faker->word,
        'slope_direction' => $faker->word,
        'landscape' => $faker->word,
        'slope_degree' => $faker->randomNumber(),
        'soil_depth' => $faker->word,
        'density' => $faker->word,
        'drainage' => $faker->word,
        'soil_ph' => $faker->word,
        'salinity' => $faker->word,
        'lime' => $faker->word,
        'climate' => $faker->word,
        'extent_population' => $faker->word,
        'vegetation' => $faker->word,
        'soil_erosion' => $faker->word,
        'land_reforming' => $faker->word,
        'sample_type' => $faker->word,
        'flowering' => $faker->word,
        'pollination' => $faker->word,
        'pollination_agent' => $faker->word,
        'fruit_type' => $faker->word,
        'seeding_bush_qt' => $faker->randomNumber(),
        'collecting_type' => $faker->word,
        'seeding_month' => $faker->word,
        'reproduction' => $faker->word,
        'vegetative_form' => $faker->word,
        'height' => $faker->randomNumber(),
        'mother_health' => $faker->word,
        'department_id' => function () {
            return factory(App\Models\Department::class)->create()->id;
        },
        'send_date' => $faker->date(),
        'collected_qt' => $faker->randomNumber(),
        'must_collected_qt' => $faker->randomNumber(),
        'critical_extensions_qt' => $faker->randomNumber(),
        'notes' => $faker->word,
    ];
});
