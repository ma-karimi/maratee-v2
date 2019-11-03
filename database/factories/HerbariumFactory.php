<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\General;
use App\Models\Plant;
use Faker\Generator as Faker;

$factory->define(App\Models\Herbarium::class, function (Faker $faker) {
    $organizations = \App\Models\Organization::pluck('id')->toArray();
    $locations = \App\Models\Location::pluck('id')->toArray();

    return [
        'taxonomy_id' => factory(App\Models\Taxonomy::class)->create()->id,
        'herbarium_number' => $faker->numberBetween(1, 100),
        'organization_id' => $faker->randomElement($organizations),
        'location_id' => $faker->randomElement($locations),
        'herbarium_index' => $faker->randomElement(['a', 'b', 'c', null])
    ];
});
