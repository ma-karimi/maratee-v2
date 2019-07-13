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
        'formation' => $faker->word,
        'layer' => $faker->word,
        'stratigraphy' => $faker->word,
        'lithology' => $faker->word,
        'fauna' => $faker->word,
        'description' => $faker->text,
        'map_id' => function () {
            return factory(App\Models\Map::class)->create()->id;
        },
    ];
});
