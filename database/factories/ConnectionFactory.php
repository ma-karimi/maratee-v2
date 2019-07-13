<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Connection::class, function (Faker $faker) {
    return [
        'location_id' => function () {
            return factory(App\Models\Location::class)->create()->id;
        },
        'department_id' => function () {
            return factory(App\Models\Department::class)->create()->id;
        },
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
    ];
});
