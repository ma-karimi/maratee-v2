<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\ActorHub::class, function (Faker $faker) {
    $actors = \App\Models\Location::pluck('id')->toArray();
//    $generals = \App\Models\General::whereIn('type', ['family', 'genus', 'species', 'variety', 'sub_species'])->pluck('id')->toArray();
    $paleontologies = \App\Models\Paleontology::pluck('id')->toArray();
    return [
        'actorable_type' => $faker->randomElement([\App\Models\Paleontology::class]),
        'actorable_id' => $faker->randomElement($paleontologies),
        'actor_id' => $faker->randomElement($actors)
    ];
});
