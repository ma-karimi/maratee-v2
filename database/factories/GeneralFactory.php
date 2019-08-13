<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\General::class, function (Faker $faker) {
    $generals = \App\Models\General::pluck('id')->toArray();
    $parent = $faker->randomElement($generals);

    return [
        'name' => make_json($faker->name),
        'description' => make_json($faker->text),
        'type' => $faker->randomElement(['phytogeography, phenology, plant_type','species, sub_species, variety, family, genus, class, group, order, flowering, sperm, cotyledon','growth, usage, part, industry, application, habitat, ecology, origin']),
    ];
});
