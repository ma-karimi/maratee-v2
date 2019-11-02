<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\BotanicalPropagation::class, function (Faker $faker) {
    $botanicals = \App\Models\Botanical::pluck('id')->toArray();
    return [
        'botanical_id' => $faker->randomElement($botanicals),
        'propagation_method_id' => $faker->numberBetween(1,7),
    ];
});
