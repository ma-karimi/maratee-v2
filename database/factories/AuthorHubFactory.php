<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\AuthorHub::class, function (Faker $faker) {
    $authors = \App\Models\Location::pluck('id')->toArray();
    $generals = \App\Models\General::whereIn('type', ['family', 'genus', 'specie', 'variety', 'sub_specie'])->pluck('id')->toArray();
    return [
        'authorable_type'=>$faker->randomElement([\App\Models\PlantHerbarium::class, \App\Models\General::class]),
        'authorable_id'=>$faker->randomElement($generals),
        'author_id' => $faker->randomElement($authors)
    ];
});
