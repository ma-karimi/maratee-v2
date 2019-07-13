<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\MedicinalPlantConstituent::class, function (Faker $faker) {
    return [
        'medicinal_plant_id' => function () {
            return factory(App\Models\MedicinalPlant::class)->create()->id;
        },
        'constituent_id' => function () {
            return factory(App\Models\Constituent::class)->create()->id;
        },
        'value' => $faker->randomNumber(),
    ];
});
