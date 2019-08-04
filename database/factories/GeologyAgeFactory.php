<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\GeologyAge::class, function (Faker $faker) {

    $ages  = \App\Models\GeologyAge::pluck('id')->toArray();
    return [
        'name' => make_json($faker->word),
        'type' => $faker->randomElement(['era', 'period', 'epoch', 'stage']),
        'parent_id' => count($ages) ? $faker->randomElement($ages) : null,
    ];
});
