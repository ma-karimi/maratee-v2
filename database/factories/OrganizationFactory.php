<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Organization::class, function (Faker $faker) {
    return [
        'domestic_code' => $faker->word,
        'international_code' => $faker->word,
        'is_herbarium' => $faker->boolean,
        'name' => make_json($faker->name),
        'description' => $faker->text,
        'phone' => $faker->phoneNumber,
        'email' => $faker->safeEmail,
        'website' => $faker->word,
        'fax' => $faker->phoneNumber,
    ];
});
