<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\ActionHub::class, function (Faker $faker) {
    $projects = \App\Models\Project::pluck('id')->toArray();
    $users = \App\Models\User::pluck('id')->toArray();
    $departments = \App\Models\Department::pluck('id')->toArray();
    $plant_herbariums = \App\Models\PlantHerbarium::pluck('id')->toArray();
    return [
        'action_id' => random_int(1,3),
        'user_id' => $faker->randomElement($users),
        'date' => $faker->dateTimeBetween(),
        'description' => make_json($faker->text),
        'project_id' => $faker->randomElement($projects),
        'department_id' => $faker->randomElement($departments),
        'actionable_type'=>$faker->randomElement([\App\Models\PlantHerbarium::class, \App\Models\CryoBank::class, \App\Models\Paleontology::class]),
        'actionable_id'=>$faker->randomElement($plant_herbariums)
    ];
});
