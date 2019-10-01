<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Article::class, function (Faker $faker) {
    return [
        'title' => make_json($faker->word),
        'year' => random_int(1950,2020),
        'journal_name' => make_json($faker->word),
        'page_no' => $faker->numberBetween(1, 100),
    ];
});
