<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Credential::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'type' => $faker->word,
        'date' => $faker->dateTimeBetween(),
        'archive_no' => $faker->word,
        'place' => $faker->word,
        'parent_id' => function () {
            return factory(App\Models\Credential::class)->create()->id;
        },
    ];
});
