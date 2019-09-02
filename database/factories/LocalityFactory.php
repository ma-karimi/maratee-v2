<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Locality::class, function (Faker $faker) {
    $maps  = \App\Models\Map::pluck('id')->toArray();
    $locations  = \App\Models\Location::pluck('id')->toArray();
    $paleontologies  = \App\Models\Paleontology::pluck('id')->toArray();
    return [
        'paleontology_id' => $faker->randomElement($paleontologies),
        'location_id' => $faker->randomElement($locations),
        'formation' => make_json($faker->word),
        'layer' => make_json($faker->word),
        'stratigraphy' => make_json($faker->word),
        'lithology' => make_json($faker->word),
        'fauna' => make_json($faker->word),
        'description' => make_json($faker->text),
    ];
});
