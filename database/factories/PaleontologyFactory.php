<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Paleontology::class, function (Faker $faker) {
    $eras = \App\Models\GeologyAge::whereTypeId(1)->pluck('id')->toArray();
    $epochs = \App\Models\GeologyAge::whereTypeId(2)->pluck('id')->toArray();
    $periods = \App\Models\GeologyAge::whereTypeId(3)->pluck('id')->toArray();
    $stages = \App\Models\GeologyAge::whereTypeId(4)->pluck('id')->toArray();
    $plants = \App\Models\Plant::pluck('id')->toArray();
    $orders = \App\Models\General::where('type', 'order')->pluck('id')->toArray();
    $plant_types = \App\Models\General::where('type', 'plant_type')->pluck('id')->toArray();
    return [
        'catalog_no' => $faker->numberBetween(1, 100),
        'taxonomy_id' => $faker->randomElement($plants),
        'general_order_id' => $faker->randomElement($orders),
        'general_plant_type_id' => $faker->randomElement($plant_types),
        'update_frequency' => $faker->word,
        'specimen_no' => $faker->word,
        'field_no' => $faker->word,
        'barcode_no' => $faker->word,
        'move_status' => $faker->text,
        'salon' => $faker->word,
        'closet' => $faker->numberBetween(1, 100),
        'drawer' => $faker->numberBetween(1, 100),
        'preservation' => $faker->word,
        'pieces' => $faker->numberBetween(1, 100),
        'color' => $faker->word,
        'element' => $faker->word,
        'geology_age_era_id' => $faker->randomElement($eras),
        'geology_age_epoch_id' => $faker->randomElement($epochs),
        'geology_age_period_id' => $faker->randomElement($periods),
        'geology_age_stage_id' => $faker->randomElement($stages),
        'additional_info' => $faker->word,
        'treatment_history' => $faker->word,
        'access_code' => $faker->word,
        'last_update' => $faker->date(),
        'excavation' => $faker->word
    ];
});
