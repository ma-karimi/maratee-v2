<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\PaleontologyCitation::class, function (Faker $faker) {
    return [
        'paleontology_id' => function () {
            return factory(App\Models\Paleontology::class)->create()->id;
        },
        'article_id' => function () {
            return factory(App\Models\Article::class)->create()->id;
        },
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'media_id' => function () {
            return factory(App\Models\Media::class)->create()->id;
        },
        'plates_no' => $faker->word,
    ];
});
