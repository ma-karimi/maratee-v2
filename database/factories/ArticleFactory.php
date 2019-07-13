<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'year' => $faker->dateTimeBetween(),
        'journal_name' => $faker->word,
        'journal_no' => $faker->randomNumber(),
        'page_no' => $faker->randomNumber(),
        'type' => $faker->word,
        'authors' => $faker->word,
    ];
});
