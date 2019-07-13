<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'education' => $faker->word,
        'degree' => $faker->word,
        'national_id' => $faker->randomNumber(),
        'birthday' => $faker->dateTimeBetween(),
        'nationality' => $faker->word,
        'passport_no' => $faker->word,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'nickname' => $faker->word,
        'is_author' => $faker->boolean,
        'mobile' => $faker->word,
        'phone' => $faker->phoneNumber,
        'email' => $faker->safeEmail,
        'work_experience' => $faker->randomNumber(),
        'deleted_at' => $faker->dateTimeBetween(),
    ];
});
