<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\PaleontologyMap::class, function (Faker $faker) {
    return [
        'reference_year' => $faker->year(),
        'scale' => $faker->word,
        'name' => $faker->word,
        'url' => $faker->word,
    ];
});
