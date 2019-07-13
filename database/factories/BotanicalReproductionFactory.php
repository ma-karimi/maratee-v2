<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\BotanicalReproduction::class, function (Faker $faker) {
    return [
        'botanical_id' => function () {
            return factory(App\Models\Botanical::class)->create()->id;
        },
        'reproduction_id' => function () {
            return factory(App\Models\Reproduction::class)->create()->id;
        },
    ];
});
