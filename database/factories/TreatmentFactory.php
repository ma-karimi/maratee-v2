<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Treatment::class, function (Faker $faker) {
    $paleontologies = \App\Models\Paleontology::pluck('id')->toArray();
    return [
        'paleontology_id' => $faker->randomElement($paleontologies),
        'name' => make_json($faker->name),
        'description' => make_json($faker->text),
    ];
});
