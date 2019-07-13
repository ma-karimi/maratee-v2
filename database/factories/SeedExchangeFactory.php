<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\SeedExchange::class, function (Faker $faker) {
    $seeds = \App\Models\Seed::pluck('id')->toArray();
    $collections = \App\Models\Collection::pluck('id')->toArray();
    return [
        'seed_id' => $faker->randomElement($seeds),
        'collection_id' => $faker->randomElement($collections),
        'type' => $faker->word,
        'weight' => $faker->randomNumber(),
        'date' => $faker->dateTimeBetween(),
        'approval_no' => make_json($faker->word),
        'saved_type' =>make_json($faker->word),
        'description' => make_json($faker->text),
    ];
});
