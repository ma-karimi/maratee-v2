<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'title' => make_json($faker->word),
        'education' => make_json($faker->word),
        'degree' => make_json($faker->word),
        'national_id' => $faker->randomNumber(),
        'birthday' => $faker->dateTimeBetween(),
        'nationality' => make_json($faker->country),
        'passport_no' => $faker->word,
        'first_name' => make_json($faker->firstName),
        'last_name' => make_json($faker->lastName),
        'nickname' => make_json($faker->word),
        'is_author' => $faker->boolean,
        'mobile' => $faker->numberBetween('09100000000','09199999999'),
        'phone' => $faker->phoneNumber,
        'email' => $faker->safeEmail,
        'work_experience' => $faker->randomNumber(),
        'password' => 'admin@123',
        'deleted_at' => $faker->dateTimeBetween(),
    ];
});
