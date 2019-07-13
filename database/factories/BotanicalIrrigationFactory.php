<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\BotanicalIrrigation::class, function (Faker $faker) {
    return [
        'botanical_id' => function () {
            return factory(App\Models\Botanical::class)->create()->id;
        },
        'irrigation_id' => function () {
            return factory(App\Models\Irrigation::class)->create()->id;
        },
        'requirement' => $faker->word,
        'daytime' => $faker->word,
        'seasonal_feature' => $faker->word,
    ];
});
