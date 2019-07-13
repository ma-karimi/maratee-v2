<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\ActionHub::class, function (Faker $faker) {
    return [
        'action_id' => function () {
            return factory(App\Models\Action::class)->create()->id;
        },
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'location_id' => function () {
            return factory(App\Models\Location::class)->create()->id;
        },
        'herbarium_id' => function () {
            return factory(App\Models\Herbarium::class)->create()->id;
        },
        'date' => $faker->dateTimeBetween(),
        'description' => make_json($faker->text),
        'project_id' => function () {
            return factory(App\Models\Project::class)->create()->id;
        },
        'department_id' => function () {
            return factory(App\Models\Department::class)->create()->id;
        },
    ];
});
