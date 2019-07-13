<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Paleontology::class, function (Faker $faker) {
    $geology_ages = \App\Models\GeologyAge::pluck('id')->toArray();

    return [
        'catalog_no' => $faker->randomNumber(),
        'specimen_no' => $faker->word,
        'field_no' => $faker->word,
        'barcode_no' => $faker->word,
        'move_status' => $faker->text,
        'salon' => $faker->word,
        'closet' => $faker->randomNumber(),
        'drawer' => $faker->randomNumber(),
        'infraspecific' => make_json($faker->word),
        'typestatus' => make_json($faker->word),
        'preservation' => make_json($faker->word),
        'pieces' => $faker->randomNumber(),
        'color' => make_json($faker->word),
        'element' => make_json($faker->word),
        'geology_age_id' => $faker->randomElement($geology_ages),
        'treatment' => make_json($faker->word),
        'additional_info' => make_json($faker->word),
        'access' => make_json($faker->word),
        'last_update' => $faker->dateTimeBetween(),
        'excavation' => make_json($faker->word),
        'collection_name' => make_json($faker->word),
        'location_no' => $faker->randomNumber(),
        'common_name' => make_json($faker->word),
    ];
});
