<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Medicine::class, function (Faker $faker) {
    $medicines=\App\Models\Medicine::pluck('id')->toArray();
    $parent=$faker->randomElement($medicines);
    return [
        'name' => make_json($faker->name),
        'description' => make_json($faker->text),
        'type' => $faker->word,
        'parent_id' => ($parent % 2) ? $parent : null,
    ];
});
