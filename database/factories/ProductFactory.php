<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    $organizations=\App\Models\Organization::pluck('id')->toArray();
    return [
        'name' => make_json($faker->name),
        'registration_status' => array_rand(\App\Models\Product::STATUS),
        'components' => $faker->text,
        'organization_id' => $faker->randomElement($organizations),
    ];
});
