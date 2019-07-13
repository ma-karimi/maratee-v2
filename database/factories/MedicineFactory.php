<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Medicine::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'type' => $faker->word,
        'parent_id' => function () {
            return factory(App\Models\Medicine::class)->create()->id;
        },
    ];
});
