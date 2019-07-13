<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\HerbariumAppendix::class, function (Faker $faker) {
    return [
        'herbarium_id' => function () {
            return factory(App\Models\Herbarium::class)->create()->id;
        },
        'appendix' => $faker->word,
        'destination_herbarium_id' => function () {
            return factory(App\Models\Herbarium::class)->create()->id;
        },
    ];
});
