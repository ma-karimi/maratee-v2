<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Transfer::class, function (Faker $faker) {
    $herbariums = \App\Models\Herbarium::pluck('id')->toArray();
    $credentials = \App\Models\Credential::pluck('id')->toArray();
    return [
        'credential_id' => $faker->randomElement($credentials),
        'entitiable_type' => $faker->randomElement([\App\Models\Herbarium::class, \App\Models\Paleontology::class]),
        'transferable_type' => $faker->randomElement([\App\Models\Visit::class, \App\Models\Borrow::class, \App\Models\Exchange::class]),
        'entitiable_id' => $faker->randomElement($herbariums),
        'transferable_id' => $faker->randomElement($herbariums),
    ];
});
