<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\CryoBank::class, function (Faker $faker) {
    $protections = \App\Models\Protection::pluck('id')->toArray();
    $herbariums = \App\Models\Herbarium::pluck('id')->toArray();
    return [
        'voucher_number' => $faker->word,
        'geotype_code' => $faker->word,
        'protection_id' => $faker->randomElement($protections),
        'entry_date' => $faker->dateTimeBetween(),
        'sample_type' => $faker->word,
        'proposal_name' => $faker->word,
        'repetition' => $faker->numberBetween(1, 100),
        'tank_type' => make_json($faker->word),
        'layering_no' => $faker->numberBetween(1, 100),
        'tank_no' => $faker->numberBetween(1, 100),
        'row_no' => $faker->numberBetween(1, 100),
        'rack_no' => $faker->word,
        'cell_no' => $faker->numberBetween(1, 100),
        'herbarium_id' => $faker->randomElement($herbariums),
    ];
});
