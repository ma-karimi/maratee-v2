<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Locality::class, function (Faker $faker) {
    $locations  = \App\Models\Location::pluck('id')->toArray();
    $paleontologies  = \App\Models\Paleontology::pluck('id')->toArray();
    return [
        'paleontology_id' => $faker->randomElement($paleontologies),
        'location_id' => $faker->randomElement($locations),
        'formation' => $faker->word,
        'layer' => $faker->word,
        'stratigraphy' => $faker->word,
        'lithology' => $faker->word,
        'fauna' => $faker->word,
        'description' => $faker->word,
    ];
});
