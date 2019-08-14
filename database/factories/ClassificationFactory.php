<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Classification::class, function (Faker $faker) {
    $plant_class_generals = \App\Models\General::where('type', 'class')->pluck('id')->toArray();
    $plant_flowering_generals = \App\Models\General::where('type', 'flowering')->pluck('id')->toArray();
    $plant_group_generals = \App\Models\General::where('type', 'group')->pluck('id')->toArray();
    $plant_order_generals = \App\Models\General::where('type', 'order')->pluck('id')->toArray();
    $plant_sperm_generals = \App\Models\General::where('type', 'sperm')->pluck('id')->toArray();
    $plant_cotyledon_generals = \App\Models\General::where('type', 'cotyledon')->pluck('id')->toArray();
    return [
        'flowering_id' => $faker->randomElement($plant_flowering_generals),
        'cotyledon_id' => ($faker->randomElement($plant_cotyledon_generals) % 2) ? $faker->randomElement($plant_cotyledon_generals) : null,
        'sperm_id' => ($faker->randomElement($plant_sperm_generals) % 3) ? $faker->randomElement($plant_sperm_generals) : null,
    ];
});
