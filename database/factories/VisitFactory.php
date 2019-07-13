<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Visit::class, function (Faker $faker) {
    return [
        'date' => $faker->dateTimeBetween(),
        'description' => $faker->text,
        'purpose' => $faker->word,
        'peoples' => $faker->randomNumber(),
        'archives_types' => $faker->word,
        'archive_no' => $faker->word,
        'paleontology_id' => function () {
            return factory(App\Models\Paleontology::class)->create()->id;
        },
        'media_id' => function () {
            return factory(App\Models\Media::class)->create()->id;
        },
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
    ];
});
