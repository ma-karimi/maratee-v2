<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Plant::class, function (Faker $faker) {
    $taxonomies = \App\Models\Taxonomy::pluck('id')->toArray();
    $flowerings = \App\Models\General::whereType('flowering')->pluck('id')->toArray();
    //dd($flowerings);

    return [
        'name' => make_json($faker->word),
        'domestic_name' => make_json($faker->word),
        'description' => make_json($faker->text),
//        'taxonomy_id' => $faker->randomElement($taxonomies),
        'flowering_id' => $faker->randomElement($flowerings),
        'exclusivity' => $faker->numberBetween(0,1),
    ];
});
