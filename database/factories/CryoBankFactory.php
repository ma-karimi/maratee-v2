<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\CryoBank::class, function (Faker $faker) {
    return [
        'voucher_number' => $faker->word,
        'geotype_code' => $faker->word,
        'protection_id' => function () {
            return factory(App\Models\Protection::class)->create()->id;
        },
        'entry_date' => $faker->dateTimeBetween(),
        'sample_type' => $faker->word,
        'treatment' => make_json($faker->word),
        'repetition' => $faker->randomNumber(),
        'tank_type' => make_json($faker->word),
        'layering_no' => $faker->randomNumber(),
        'tank_no' => $faker->randomNumber(),
        'row_no' => $faker->randomNumber(),
        'rack_no' => $faker->word,
        'cell_no' => $faker->randomNumber(),
        'herbarium_id' => function () {
            return factory(App\Models\Herbarium::class)->create()->id;
        },
    ];
});
