<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\PaleontologyCitation::class, function (Faker $faker) {
    $paleontologies = \App\Models\Paleontology::pluck('id')->toArray();
    $actors = \App\Models\Actor::pluck('id')->toArray();
    return [
        'paleontology_id' => $faker->randomElement($paleontologies),
        'actor_id' => $faker->randomElement($actors),
        'year'=>$faker->numberBetween(1900,2018),
        'publication_name'=>make_json($faker->word),
        'volume'=>$faker->word,
        'pages'=>$faker->randomNumber(3),
        'plates'=>$faker->randomNumber(3),
        'figures_number'=>$faker->randomNumber(3),
    ];
});
