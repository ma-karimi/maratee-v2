<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\LifeForm::class, function (Faker $faker) {

    $data = [
        'wooden' => ['tree','shrubs'],
        'herbaceous' => ['standing','crawling'],
        'leaf' => ['broad_leaf','needle_leaf'],
        'life_cycle' => ['annual','biennial','perennial'],
    ];
    $random_key=$faker->randomKey($data);
    return  [
        'type' => $random_key,
        'name' => make_json($faker->randomElement($data[$random_key])),
    ];
});
