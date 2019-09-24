<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Chromosome::class, function (Faker $faker) {
    $classes = \App\Models\General::where('type', 'class')->pluck('id')->toArray();
    return [
        'v_number' => $faker->word,
        'n_no' => $faker->word,
        '2n_no' => $faker->word,
        'description' => make_json($faker->word),
        'plant_herbarium_id' => function () {
            return factory(App\Models\PlantHerbarium::class)->create()->id;
        },
        'general_class_id' => $faker->randomElement($classes),
    ];
});
