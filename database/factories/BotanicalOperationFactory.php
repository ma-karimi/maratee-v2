<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\BotanicalOperation::class, function (Faker $faker) {
    return [
        'botanical_id' => $faker->randomElement(\App\Models\Botanical::pluck('id')->toArray()),
        'garden_id' => $faker->randomElement(\App\Models\InternalHabitat::pluck('id')->toArray()),
        'date' => $faker->dateTimeBetween(),
        'operation_id' => $faker->numberBetween(1,2),
        'number' => $faker->word,
        'description' =>$faker->word
    ];
});
