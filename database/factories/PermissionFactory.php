<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Permission::class, function (Faker $faker) {
    return [
        'set_name' => $faker->word,
        'set_value' => $faker->word,
    ];
});
