<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Chromosome::class, function (Faker $faker) {
    return [
        'n_no' => $faker->randomNumber(),
        '2n_no' => $faker->randomNumber(),
        'notes' => $faker->word,
        'herbarium_id' => function () {
            return factory(App\Models\Herbarium::class)->create()->id;
        },
        'cryo_bank_id' => function () {
            return factory(App\Models\CryoBank::class)->create()->id;
        },
        'article_id' => function () {
            return factory(App\Models\Article::class)->create()->id;
        },
        'location_id' => function () {
            return factory(App\Models\Location::class)->create()->id;
        },
    ];
});
