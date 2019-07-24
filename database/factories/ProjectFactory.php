<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Project::class, function (Faker $faker) {
    return [
        'name' => make_json($faker->name),
        'plan_name' => make_json($faker->word),
        'plan_description' => make_json($faker->word),
        'plan_number' => make_json($faker->word),
        'approved_id' => $faker->word,
        'registered_id' => $faker->word,
        'plan_id' => $faker->numberBetween(1, 100),
    ];
});
