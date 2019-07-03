<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Service::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
//        'image'=>$faker->sha256,
        'price'=>$faker->randomDigit,
        'description'=>$faker->sentence,
        'priority'=>$faker->randomDigit,
        'reserved_count'=>$faker->randomDigit,
        'status'=>1
    ];
});
