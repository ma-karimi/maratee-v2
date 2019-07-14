<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Borrow::class, function (Faker $faker) {
    $users = \App\Models\User::pluck('id')->toArray();
    $herbariums = \App\Models\Herbarium::pluck('id')->toArray();
    $medias = \App\Models\Media::pluck('id')->toArray();

    return [
        'herbarium_id' => $faker->randomElement($herbariums),
        'user_id' => $faker->randomElement($users),
        'borrows_date' => $faker->dateTimeBetween(),
        'sheets_no' => $faker->randomNumber(),
        'deadline' => $faker->dateTimeBetween(),
        'return' => $faker->dateTimeBetween(),
        'media_id' => $faker->randomElement($medias),
    ];
});
