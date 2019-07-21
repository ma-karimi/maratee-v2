<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Permission::class, function (Faker $faker) {
    $users = \App\Models\User::pluck('id')->random();
    $departments = \App\Models\Department::pluck('id')->random();
    $groups = \App\Models\Group::pluck('id')->random();
    $roles = \App\Models\Role::pluck('id')->random();
    return [
        'user_id' => $users,
        'department_id' => $departments,
        'role_id' => $roles,
        'group_id' => $groups,
        'permission_status' => $faker->numberBetween(0,1),
        'requester_id' => $users,
        'responser_id' => $users,
        'request_date' => $faker->dateTime,
        'approval_date' => $faker->dateTime,
        'expire_date' => $faker->dateTime,
        'owner_crud' => make_json($faker->numberBetween(0,1)),
        'same_level_crud' => make_json($faker->numberBetween(0,1)),
        'upper_level_crud' => make_json($faker->numberBetween(0,1)),
        'lower_level_crud' => make_json($faker->numberBetween(0,1)),

    ];
});
