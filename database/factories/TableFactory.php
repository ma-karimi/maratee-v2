<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Table::class, function (Faker $faker) {
    $departments = \App\Models\Department::pluck('id')->random();
    return [
        'table_name' => $faker->name,
        'department_id' => $departments,
        'ownership' => $faker->numberBetween(0,1),
        'create' => $faker->numberBetween(0,1),
        'read' => $faker->numberBetween(0,1),
        'write' => $faker->numberBetween(0,1),
        'delete' => $faker->numberBetween(0,1),
        'copy' => $faker->numberBetween(0,1),
    ];
});
