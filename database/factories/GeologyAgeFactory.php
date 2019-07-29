<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\GeologyAge::class, function (Faker $faker) {
    return [
        'era' => make_json($faker->word),
        'period' => make_json($faker->word),
        'epoch' => make_json($faker->word),
        'stage' => make_json($faker->word),
    ];
});
