<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'registration_status' => $faker->word,
        'organization_id' => function () {
            return factory(App\Models\Organization::class)->create()->id;
        },
    ];
});
