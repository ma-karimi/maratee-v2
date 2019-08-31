<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use Grimzy\LaravelMysqlSpatial\Types\Point;

$factory->define(App\Models\Location::class, function (Faker $faker) {
    $cities = \App\Models\City::pluck('id')->toArray();

    return [
        'address' => make_json($faker->name),
        'region_name' => make_json($faker->name),
        'altitude' => $faker->numberBetween(1, 100),
        //'point' => new Point($faker->randomFloat(null, 36.5988295, 37.65656), $faker->randomFloat(null, 56.565665, 58.656565)),
        'point' => ['48°49′24″N','2°18′26″E'],
        'description' => make_json($faker->text),
        'city_id' => $faker->randomElement($cities),
    ];
});
