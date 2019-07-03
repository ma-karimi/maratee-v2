<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Commission::class, function (Faker $faker) {
    return [
        'provider_id' => $faker->numberBetween(16,18),
        'reserve_id' => 1,
        'commission'=>$faker->numberBetween(1000,400000)
    ];
});
