<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Treatment::class, function (Faker $faker) {

    return [
        'paleontology_id' => function () {
            return factory(App\Models\Paleontology::class)->create()->id;
        },
        'name' => make_json($faker->name),
        'description' => make_json($faker->text),
    ];
});
