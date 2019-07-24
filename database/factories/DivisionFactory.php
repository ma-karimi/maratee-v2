<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Division::class, function (Faker $faker) {

    $departmentIds= \App\Models\Department::pluck('id')->random();

    return [
        'name' => make_json($faker->name),
        'department_id' => $departmentIds,
    ];
});
