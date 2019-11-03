<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\ActionHub::class, function (Faker $faker) {
    $projects = \App\Models\Project::pluck('id')->toArray();
    $departments = \App\Models\Department::pluck('id')->toArray();
    $plant_herbariums = \App\Models\Plant::pluck('id')->toArray();
    return [
        'action_id' => random_int(1,3),
        'date' => $faker->dateTimeBetween(),
        'description' => make_json($faker->text),
        'project_id' => $faker->randomElement($projects),
        'department_id' => $faker->randomElement($departments),
        'actionable_type'=>$faker->randomElement([\App\Models\Plant::class, \App\Models\CryoBank::class, \App\Models\Paleontology::class]),
        'actionable_id'=>$faker->randomElement($plant_herbariums)
    ];
});
