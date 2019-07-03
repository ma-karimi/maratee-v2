<?php

use Faker\Generator as Faker;

$categories = \App\Models\Category::pluck('id')->toArray();

$factory->define(\App\Models\Product::class, function (Faker $faker) use ($categories) {
    return [
        'title' => $faker->word,
        'description' => $faker->sentence,
        'category_id' => $faker->randomElement($categories),
        'status' => 1,
    ];
});
