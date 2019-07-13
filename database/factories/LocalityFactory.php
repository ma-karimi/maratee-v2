<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Locality::class, function (Faker $faker) {
    return [
        'paleontology_id' => function () {
            return factory(App\Models\Paleontology::class)->create()->id;
        },
        'location_id' => function () {
            return factory(App\Models\Location::class)->create()->id;
        },
        'formation' => make_json($faker->word),
        'layer' => make_json($faker->word),
        'stratigraphy' => make_json($faker->word),
        'lithology' => make_json($faker->word),
        'fauna' => make_json($faker->word),
        'description' => make_json($faker->text),
        'map_id' => function () {
            return factory(App\Models\Map::class)->create()->id;
        },
    ];
});
