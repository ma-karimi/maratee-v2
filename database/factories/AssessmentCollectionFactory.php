<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\AssessmentCollection::class, function (Faker $faker) {
    $collections = \App\Models\Collection::pluck('id')->toArray();
    $assessments = \App\Models\Assessment::pluck('id')->toArray();
    $departments = \App\Models\Department::pluck('id')->toArray();
    $projects = \App\Models\Project::pluck('id')->toArray();
    $seeds = \App\Models\Seed::pluck('id')->toArray();
    return [
        'collection_id' => $faker->randomElement($collections),
        'assessment_id' => $faker->randomElement($assessments),
        'seed_id' =>  $faker->randomElement($seeds),
        'department_id' =>  $faker->randomElement($departments),
        'project_id' =>  $faker->randomElement($projects),
    ];
});
