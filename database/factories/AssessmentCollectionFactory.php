<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\AssessmentCollection::class, function (Faker $faker) {
    return [
        'collection_id' => function () {
            return factory(App\Models\Collection::class)->create()->id;
        },
        'assessment_id' => function () {
            return factory(App\Models\Assessment::class)->create()->id;
        },
        'seed_id' => function () {
            return factory(App\Models\Seed::class)->create()->id;
        },
        'department_id' => function () {
            return factory(App\Models\Department::class)->create()->id;
        },
        'project_id' => function () {
            return factory(App\Models\Project::class)->create()->id;
        },
    ];
});
