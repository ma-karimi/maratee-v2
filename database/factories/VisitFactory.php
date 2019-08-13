<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Visit::class, function (Faker $faker) {
    $users = \App\Models\User::pluck('id')->toArray();
    $paleontologies = \App\Models\Paleontology::pluck('id')->toArray();
    $models = [\App\Models\Paleontology::class, \App\Models\Herbarium::class];
    return [
        'start_time' => $faker->dateTimeBetween(),
        'end_time' => $faker->dateTimeBetween(),
        'description' => make_json($faker->text),
        'purpose' => make_json($faker->word),
        'peoples_no' => $faker->numberBetween(1, 100),
        'archives_types' => $faker->word,
        'archive_no' => $faker->word,
        'visitable_id' => $faker->randomElement($paleontologies),
        'visitable_type' => $faker->randomElement($models),
        'user_id' =>$faker->randomElement($users),
    ];
});
