<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Visit::class, function (Faker $faker) {
    $users = \App\Models\User::pluck('id')->toArray();
    $medias = \App\Models\Media::pluck('id')->toArray();
    $paleontologies = \App\Models\Paleontology::pluck('id')->toArray();

    return [
        'date' => $faker->dateTimeBetween(),
        'description' => make_json($faker->text),
        'purpose' => make_json($faker->word),
        'peoples' => $faker->numberBetween(1, 100),
        'archives_types' => $faker->word,
        'archive_no' => $faker->word,
        'paleontology_id' => $faker->randomElement($paleontologies),
        'media_id' => $faker->randomElement($medias),
        'user_id' =>$faker->randomElement($users),
    ];
});
