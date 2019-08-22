<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\PlantLifeForm::class, function (Faker $faker) {
    $forms = \App\Models\LifeForm::whereIn('type', ['wooden', 'herbaceous'])->select('id', 'type')->get()->toArray();
    $record = $faker->randomElement($forms);
    $plants = \App\Models\LifeForm::whereIn('type', ['wooden', 'herbaceous'])->pluck('id')->toArray();
    return [
        'life_form_id' => $record['id'],
        'type' => $record['type'],
        'plant_id' => $faker->randomElement($plants),
    ];
});
