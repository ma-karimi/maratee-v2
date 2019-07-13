<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Project::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'plan_name' => $faker->word,
        'plan_description' => $faker->word,
        'plan_number' => $faker->word,
        'approved_id' => $faker->word,
        'registered_id' => $faker->word,
        'plan_id' => $faker->randomNumber(),
    ];
});
