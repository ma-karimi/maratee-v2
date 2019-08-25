<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Article::class, function (Faker $faker) {
    return [
        'title' => make_json($faker->word),
        'year' => $faker->dateTimeBetween(),
        'journal_name' => make_json($faker->word),
        'journal_no' => $faker->numberBetween(1, 100),
        'page_no' => $faker->numberBetween(1, 100),
        'type' => make_json($faker->word),
        //'authors' => make_json($faker->word),
    ];
});
