<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\PaleontologyCitation::class, function (Faker $faker) {
    $paleontologies = \App\Models\Paleontology::pluck('id')->toArray();
    $articles = \App\Models\Article::pluck('id')->toArray();
    $users = \App\Models\User::pluck('id')->toArray();
    $medias = \App\Models\Media::pluck('id')->toArray();
    return [
        'paleontology_id' => $faker->randomElement($paleontologies),
        'article_id' => $faker->randomElement($articles),
        'user_id' => $faker->randomElement($users),
        'media_id' => $faker->randomElement($medias),
        'plates_no' => $faker->word,
    ];
});
