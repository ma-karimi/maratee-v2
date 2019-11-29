<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\InternalHabitat::class, function (Faker $faker) {
    return [
        'name_en' => $faker->word,
    ];
});
