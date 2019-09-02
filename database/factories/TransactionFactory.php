<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {

    $users = \App\Models\User::pluck('id')->toArray();
    $organizations = \App\Models\Organization::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($users),
        'organization_id' => $faker->randomElement($users),
        'start_time' => $faker->dateTime,
        'type_id' => $faker->numberBetween(1,7),
        'archive_no' => $faker->word,
        'description' => make_json($faker->word),
        'purpose' => make_json($faker->word),
        'visit' => $faker->numberBetween(1,2),
        'peoples_no' => $faker->numberBetween(1,50),
        'person_position' => make_json($faker->word),
    ];
});
