<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Exchange::class, function (Faker $faker) {
    return [
        'send_herbarium_id' => function () {
            return factory(App\Models\Herbarium::class)->create()->id;
        },
        'send_date' => $faker->dateTimeBetween(),
        'receive_date' => $faker->dateTimeBetween(),
        'description' => $faker->text,
        'receive_herbarium_id' => function () {
            return factory(App\Models\Herbarium::class)->create()->id;
        },
        'send_sheet_no' => $faker->randomNumber(),
        'send_sample_no' => $faker->randomNumber(),
        'receive_sheet_no' => $faker->randomNumber(),
        'receive_sample_no' => $faker->randomNumber(),
        'send_type' => $faker->word,
        'receive_type' => $faker->word,
        'send_paleontology_id' => function () {
            return factory(App\Models\Paleontology::class)->create()->id;
        },
        'receive_paleontology_id' => function () {
            return factory(App\Models\Paleontology::class)->create()->id;
        },
    ];
});
