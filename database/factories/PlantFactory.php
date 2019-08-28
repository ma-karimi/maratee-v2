<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Plant::class, function (Faker $faker) {
    $taxonomies = \App\Models\Taxonomy::pluck('id')->toArray();
    $flowerings = \App\Models\General::whereType('flowering')->pluck('id')->toArray();
    $sperms = \App\Models\General::whereType('sperm')->pluck('id')->toArray();
    $cotyledons = \App\Models\General::whereType('cotyledon')->pluck('id')->toArray();

    return [
        'name' => make_json($faker->word),
        'domestic_name' => make_json($faker->word),
        'description' => make_json($faker->text),
        'flowering_id' => $faker->randomElement($flowerings),
        'cotyledon_id' => $faker->randomElement($cotyledons),
        'sperm_id' => $faker->randomElement($sperms),
        'exclusivity' => $faker->numberBetween(0,1),
    ];
});
