<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\BotanicalOperation::class, function (Faker $faker) {
    return [
        'botanical_id' => function () {
            return factory(App\Models\Botanical::class)->create()->id;
        },
        'location_id' => function () {
            return factory(App\Models\Location::class)->create()->id;
        },
        'date' => $faker->dateTimeBetween(),
        'operation_id' => $faker->numberBetween(1,2),
        'number' => $faker->word,
        'description' =>make_json($faker->word)
    ];
});
