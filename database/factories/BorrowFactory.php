<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Borrow::class, function (Faker $faker) {
    $users = \App\Models\User::pluck('id')->toArray();

    return [
        'herbarium_id' => function () {
            return factory(App\Models\Herbarium::class)->create()->id;
        },
        'user_id' => $faker->randomElement($users),
        'borrows_date' => $faker->dateTimeBetween(),
        'sheets_no' => $faker->randomNumber(),
        'deadline' => $faker->dateTimeBetween(),
        'return' => $faker->dateTimeBetween(),
        'media_id' => function () {
            return factory(App\Models\Media::class)->create()->id;
        },
    ];
});
