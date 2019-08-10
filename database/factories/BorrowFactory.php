<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Borrow::class, function (Faker $faker) {

    $borrowables = [\App\Models\Herbarium::class, \App\Models\Paleontology::class];
    $herbariums = \App\Models\Herbarium::pluck('id')->toArray();
    $departments = \App\Models\Department::pluck('id')->toArray();


    return [
        'borrowable_type' => $faker->randomElement($borrowables),
        'borrowable_id' => $faker->randomElement($herbariums),
        'borrows_date' => $faker->dateTimeBetween(),
        'sheets_no' => $faker->numberBetween(1, 100),
        'deadline' => $faker->dateTimeBetween(),
        'return' => $faker->dateTimeBetween(),
        'send_department_id' => $faker->randomElement($departments),
        'receive_department_id' => $faker->randomElement($departments),
    ];
});
