<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\MedicinalPlantType::class, function (Faker $faker) {

    return [
        'name' => make_json($faker->word),
        'description' => make_json($faker->text),
        'type_id' => $faker->numberBetween(1, 10)
    ];
});
