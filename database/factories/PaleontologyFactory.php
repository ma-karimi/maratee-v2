<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Paleontology::class, function (Faker $faker) {
    $eras = \App\Models\GeologyAge::whereType('era')->pluck('id')->toArray();
    $epochs = \App\Models\GeologyAge::whereType('epoch')->pluck('id')->toArray();
    $periods = \App\Models\GeologyAge::whereType('period')->pluck('id')->toArray();
    $stages = \App\Models\GeologyAge::whereType('stage')->pluck('id')->toArray();
    $plants = \App\Models\Plant::pluck('id')->toArray();
    $locations = \App\Models\Location::pluck('id')->toArray();
    $a = [
        'catalog_no' => $faker->numberBetween(1, 100),
        'plant_id' => $faker->randomElement($plants),
        'location_id' => $faker->randomElement($locations),
        'update_frequency' => $faker->word,
        'specimen_no' => $faker->word,
        'field_no' => $faker->word,
        'barcode_no' => $faker->word,
        'move_status' => $faker->text,
        'salon' => $faker->word,
        'closet' => $faker->numberBetween(1, 100),
        'drawer' => $faker->numberBetween(1, 100),
        'infra_specific' => make_json($faker->word),
        'type_status' => make_json($faker->word),
        'preservation' => make_json($faker->word),
        'pieces' => $faker->numberBetween(1, 100),
        'color' => make_json($faker->word),
        'element' => make_json($faker->word),
        'geology_age_era_id' => $faker->randomElement($eras),
        'geology_age_epoch_id' => $faker->randomElement($epochs),
        'geology_age_period_id' => $faker->randomElement($periods),
        'geology_age_stage_id' => $faker->randomElement($stages),
        'plates_no' => $faker->numberBetween(1, 100),
        'description' => make_json($faker->text),
        'additional_info' => make_json($faker->word),
        'access_code' => $faker->word,
        'last_update' => $faker->date(),
        'excavation' => make_json($faker->word),
        'collector_name' => make_json($faker->word),
        'common_name' => make_json($faker->word),
    ];
    return $a;
});
