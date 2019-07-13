<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\TechnologyCollection::class, function (Faker $faker) {
    return [
        'seed_technology_id' => function () {
            return factory(App\Models\SeedTechnology::class)->create()->id;
        },
        'collection_id' => function () {
            return factory(App\Models\Collection::class)->create()->id;
        },
    ];
});
