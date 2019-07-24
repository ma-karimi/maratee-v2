<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Transition::class, function (Faker $faker) {
    $tables = \App\Models\Table::pluck('id')->random();
    $users = \App\Models\User::pluck('id')->random();
    return [
        'table_name' => $faker->name,
        'field_name' => $faker->name,
        'table_id' => $faker->numberBetween(1, 100),
        'tables_id' => $tables,
        'status' => $faker->numberBetween(0,1),
        'crud_type' => $faker->numberBetween(0,1),
        'creator_id' => $users,
        'requester_id' => $users,
        'changer_id' => $users,
        'responser_id' => $users,
        'request_date' => $faker->dateTime,
        'change_date' => $faker->dateTime,
        'response_date' => $faker->dateTime,
        'request_status' => $faker->numberBetween(0,1),
        'previous_value' => make_json($faker->name),
        'next_value' => make_json($faker->name),
        'description' => make_json($faker->sentence),

    ];
});
