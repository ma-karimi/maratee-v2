<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Attendance::class, function (Faker $faker) {
    $users = \App\Models\User::pluck('id')->toArray();
    return [
        'start_time' => $faker->dateTimeBetween(),
        'end_time' => $faker->dateTimeBetween(),
        'herbarium_id' => function () {
            return factory(App\Models\Herbarium::class)->create()->id;
        },
        'user_id' => $faker->randomElement($users),
    ];
});
