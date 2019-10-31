<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Method::class, function (Faker $faker) {

    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'type_id' =>   array_rand(\App\Models\Method::TYPE),
    ];
});
