<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\ActorHub::class, function (Faker $faker) {
    $actors = \App\Models\Location::pluck('id')->toArray();
    $generals = \App\Models\General::whereIn('type', ['family', 'genus', 'specie', 'variety', 'sub_specie'])->pluck('id')->toArray();
    return [
        'actorable_type'=>$faker->randomElement([\App\Models\PlantHerbarium::class, \App\Models\General::class]),
        'actorable_id'=>$faker->randomElement($generals),
        'actor_id' => $faker->randomElement($actors)
    ];
});
