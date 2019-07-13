<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\MedicinalPlantMorphology::class, function (Faker $faker) {
    return [
        'medicinal_plant_id' => function () {
            return factory(App\Models\MedicinalPlant::class)->create()->id;
        },
        'morphology_id' => function () {
            return factory(App\Models\Morphology::class)->create()->id;
        },
        'value' => $faker->word,
    ];
});
