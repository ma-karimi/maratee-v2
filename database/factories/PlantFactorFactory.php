<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\PlantFactor::class, function (Faker $faker) {
    return [
        'name' => make_json($faker->name),
        'description' => make_json($faker->text),
        'type' => $faker->randomKey(['part', 'usage_type', 'application', 'growth', 'industry', 'habitat', 'ecology', 'origin']),
        'parent_id' => $faker->randomNumber(),
    ];
});
