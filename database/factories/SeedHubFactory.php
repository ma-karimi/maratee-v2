<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\SeedHub::class, function (Faker $faker) {
    return [
        'project_id' => function () {
            return factory(App\Models\Project::class)->create()->id;
        },
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'action_role' => $faker->word,
        'action_role_description' => $faker->word,
        'seed_id' => function () {
            return factory(App\Models\Seed::class)->create()->id;
        },
        'location_id' => function () {
            return factory(App\Models\Location::class)->create()->id;
        },
        'action_id' => function () {
            return factory(App\Models\Action::class)->create()->id;
        },
        'date' => $faker->dateTimeBetween(),
    ];
});
