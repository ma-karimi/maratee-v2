<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\evaluationCollection::class, function (Faker $faker) {
    $collections = \App\Models\Collection::pluck('id')->toArray();
    $evaluations = \App\Models\evaluation::pluck('id')->toArray();
    $departments = \App\Models\Department::pluck('id')->toArray();
    $projects = \App\Models\Project::pluck('id')->toArray();
    $seeds = \App\Models\Seed::pluck('id')->toArray();
    return [
        'collection_id' => $faker->randomElement($collections),
        'evaluation_id' => $faker->randomElement($evaluations),
        'seed_id' =>  $faker->randomElement($seeds),
        'department_id' =>  $faker->randomElement($departments),
        'project_id' =>  $faker->randomElement($projects),
    ];
});
