<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Project::class, function (Faker $faker) {
    $users  =\App\Models\User::pluck('id')->toArray();
    return [
        'title' => make_json($faker->name),
        'project_no' => $faker->word,
        'research_no' => $faker->word,
        'research_title' => make_json($faker->word),
        'project_leader_id'=>$faker->randomElement($users),
        'research_leader_id'=>$faker->randomElement($users),
    ];
});
