<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\SeedExchange::class, function (Faker $faker) {
    return [
        'seed_id' => function () {
            return factory(App\Models\Seed::class)->create()->id;
        },
        'collection_id' => function () {
            return factory(App\Models\Collection::class)->create()->id;
        },
        'type' => $faker->word,
        'weight' => $faker->randomNumber(),
        'date' => $faker->dateTimeBetween(),
        'approval_no' => make_json($faker->word),
        'saved_type' =>make_json($faker->word),
        'description' => make_json($faker->text),
    ];
});
