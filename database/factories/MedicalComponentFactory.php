<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\MedicalComponent::class, function (Faker $faker) {
    $components = App\Models\Component::pluck('id')->toArray();
    $medicals = App\Models\Medical::pluck('id')->toArray();
    return [
        'component_id' => $faker->randomElement($components),
        'medical_id' => $faker->randomElement($components),
        'is_active' => $faker->randomElement([0,1]),
    ];
});
