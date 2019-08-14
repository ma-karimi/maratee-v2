<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\LocationHub::class, function (Faker $faker) {
    $locationables = \App\Models\Location::pluck('id')->toArray();
    return [
        'locationable_type'=>$faker->randomElement([\App\Models\Plant::class, \App\Models\Chromosome::class, \App\Models\MedicinalPlant::class]),
        'locationable_id' => $faker->randomElement($locationables)
    ];
});
