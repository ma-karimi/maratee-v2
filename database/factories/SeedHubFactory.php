<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\SeedHub::class, function (Faker $faker) {
    $projects=\App\Models\Project::pluck('id')->toArray();
    $users=\App\Models\User::pluck('id')->toArray();
    $seeds=\App\Models\Seed::pluck('id')->toArray();
    $locations=\App\Models\Location::pluck('id')->toArray();
    $actions=\App\Models\Action::pluck('id')->toArray();
    return [
        'project_id' => $faker->randomElement($projects),
        'user_id' => $faker->randomElement($users),
        'action_role' => make_json($faker->word),
        'action_role_description' => make_json($faker->word),
        'seed_id' => $faker->randomElement($seeds),
        'location_id' => $faker->randomElement($locations),
        'action_id' => $faker->randomElement($actions),
        'date' => $faker->dateTimeBetween(),
    ];
});
