<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\MedicinalPlantMethod::class, function (Faker $faker) {
    return [
        'medicinal_plant_id' => function () {
            return factory(App\Models\MedicinalPlant::class)->create()->id;
        },
        'method_id' => function () {
            return factory(App\Models\Method::class)->create()->id;
        },
    ];
});
