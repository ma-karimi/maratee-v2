<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$types = ['species', 'sub_species', 'variety', 'family', 'genus'/*, 'group', 'order', 'growth', 'usage', 'part', 'industry', 'application'*/];
$factory->define(App\Models\General::class, function (Faker $faker) use ($types) {
    $generals = \App\Models\General::pluck('id')->toArray();

    return [
        'name' => $faker->name,
        'description' =>$faker->text,
        'type' => $faker->randomElement($types),
        'parent_id' => $faker->randomElement($generals),
    ];
});
