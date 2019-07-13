<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\ArticleHub::class, function (Faker $faker) {
    return [
        'article_id' => function () {
            return factory(App\Models\Article::class)->create()->id;
        },
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'action_id' => function () {
            return factory(App\Models\Action::class)->create()->id;
        },
        'location_id' => function () {
            return factory(App\Models\Location::class)->create()->id;
        },
        'cryo_bank_id' => function () {
            return factory(App\Models\CryoBank::class)->create()->id;
        },
        'date' => $faker->dateTimeBetween(),
    ];
});
