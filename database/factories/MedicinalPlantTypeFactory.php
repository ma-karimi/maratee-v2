<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MedicinalPlantType;
use Faker\Generator as Faker;

$factory->define(MedicinalPlantType::class, function (Faker $faker) {

    return [
        'name' => make_json($faker->word),
        'description' => make_json($faker->text),
        'type_id' => array_rand(MedicinalPlantType::TYPE),
    ];
});
