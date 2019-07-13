<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Method::class, function (Faker $faker) {
    return [
        'name' => make_json($faker->name),
        'description' => make_json($faker->text),
        'parent_id' => function () {
            return factory(App\Models\Method::class)->create()->id;
        },
    ];
});
