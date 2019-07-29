<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\PlantGeneral::class, function (Faker $faker) {
    $generals = \App\Models\PlantGeneral::pluck('id')->toArray();
    $parent = $faker->randomElement($generals);

    return [
        'name' => make_json($faker->name),
        'description' => make_json($faker->text),
        'type' => $faker->randomElement(['species', 'sub_species', 'variety', 'family', 'genus', 'class', 'group', 'order', 'flowering', 'sperm', 'cotyledon']),
        'parent_id' =>  ($parent % 2) ? $parent : null,
    ];
});
