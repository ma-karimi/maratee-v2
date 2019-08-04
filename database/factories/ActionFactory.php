<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
$action_names=['exploring','collecting','identifying','transferring','determinator'];
$factory->define(App\Models\Action::class, function (Faker $faker) use ($action_names){
    return [
        'name' => make_json($faker->randomElement($action_names)),
        'description' => make_json($faker->text),
    ];
});
