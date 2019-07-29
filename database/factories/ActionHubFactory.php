<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\ActionHub::class, function (Faker $faker) {
    $actions = \App\Models\Action::pluck('id')->toArray();
    $users = \App\Models\User::pluck('id')->toArray();
    $locations = \App\Models\Location::pluck('id')->toArray();
    $projects = \App\Models\Project::pluck('id')->toArray();
    $departments = \App\Models\Department::pluck('id')->toArray();
    return [
        'action_id' => $faker->randomElement($actions),
        'user_id' => $faker->randomElement($users),
        'location_id' => $faker->randomElement($locations),
        'herbarium_id' => $faker->numberBetween(1, 50),
        'date' => $faker->dateTimeBetween(),
        'description' => make_json($faker->text),
        'project_id' => $faker->randomElement($projects),
        'department_id' => $faker->randomElement($departments),
    ];
});
