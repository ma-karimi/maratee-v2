<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Chromosome::class, function (Faker $faker) {
    $classes = \App\Models\General::where('type', 'class')->pluck('id')->toArray();
    return [
        'n_no' => $faker->numberBetween(1, 100),
        '2n_no' => $faker->numberBetween(1, 100),
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
        'general_class_id' => $faker->randomElement($classes),
    ];
});
