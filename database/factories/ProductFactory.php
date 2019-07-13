<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'name' => make_json($faker->name),
        'description' => make_json($faker->text),
        'registration_status' => $faker->word,
        'organization_id' => function () {
            return factory(App\Models\Organization::class)->create()->id;
        },
    ];
});
