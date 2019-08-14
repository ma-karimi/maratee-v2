<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Plant::class, function (Faker $faker) {
    $taxonomies = \App\Models\Taxonomy::pluck('id')->toArray();
    $classifications = \App\Models\Classification::pluck('id')->toArray();
    return [
        'name' => make_json($faker->word),
        'domestic_name' => make_json($faker->word),
        'description' => make_json($faker->text),
        'taxonomy_id' => $faker->randomElement($taxonomies),
        'classification_id' => $faker->randomElement($classifications)
    ];
});
