<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Division::class, function (Faker $faker) {

    $departments= \App\Models\Department::pluck('id')->toArray();

    return [
        'name' => make_json($faker->name),
        'department_id' => $faker->randomElement($departments),
    ];
});
