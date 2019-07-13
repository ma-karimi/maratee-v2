<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use Grimzy\LaravelMysqlSpatial\Types\Point;

$factory->define(App\Models\Location::class, function (Faker $faker) {
    $addresses = \App\Models\Address::pluck('id')->toArray();
    $regions = \App\Models\Region::pluck('id')->toArray();
    return [
        'address_id' => $faker->randomElement($addresses),
        'region_id' => $faker->randomElement($regions),
        'altitude' => $faker->randomNumber(),
        'point' => new Point($faker->randomFloat(null, 36.5988295, 37.65656), $faker->randomFloat(null, 56.565665, 58.656565)),
        'name' => make_json($faker->name),
        'description' => make_json($faker->text),
    ];
});
