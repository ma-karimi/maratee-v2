<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\LifeForm::class, function (Faker $faker) {
    return [
        'name' => make_json($faker->word),
        'type' => $faker->randomElement(['wooden','leaf', 'herbaceos', 'life_cycle']),
    ];
});
