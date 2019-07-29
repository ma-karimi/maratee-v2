<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\PaleontologyAction::class, function (Faker $faker) {
    $paleontologies = \App\Models\Paleontology::pluck('id')->toArray();
    $actions = \App\Models\Action::pluck('id')->toArray();
    $users = \App\Models\User::pluck('id')->toArray();
    return [
        'paleontology_id' => $faker->randomElement($paleontologies),
        'user_id' => $faker->randomElement($users),
        'action_id' => $faker->randomElement($actions),
        'date' => $faker->dateTimeBetween(),
        'description' => make_json($faker->text),
    ];
});
