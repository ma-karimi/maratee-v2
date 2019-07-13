<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Paleontology::class, function (Faker $faker) {
    return [
        'catalog_no' => $faker->randomNumber(),
        'specimen_no' => $faker->word,
        'field_no' => $faker->word,
        'barcode_no' => $faker->word,
        'move_status' => $faker->text,
        'salon' => $faker->word,
        'closet' => $faker->randomNumber(),
        'drawer' => $faker->randomNumber(),
        'infraspecific' => $faker->word,
        'typestatus' => $faker->word,
        'preservation' => $faker->word,
        'pieces' => $faker->randomNumber(),
        'color' => $faker->word,
        'element' => $faker->word,
        'geology_age_id' => function () {
            return factory(App\Models\GeologyAge::class)->create()->id;
        },
        'treatment' => $faker->word,
        'additional_info' => $faker->word,
        'access' => $faker->word,
        'last_update' => $faker->dateTimeBetween(),
        'excavation' => $faker->word,
        'collection_name' => $faker->word,
        'location_no' => $faker->randomNumber(),
        'common_name' => $faker->word,
    ];
});
