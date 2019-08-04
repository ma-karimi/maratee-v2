<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Credential::class, function (Faker $faker) {
    $credentials = \App\Models\Credential::pluck('id')->toArray();
    $divisions = \App\Models\Division::pluck('id')->toArray();
    $departments = \App\Models\Department::pluck('id')->toArray();
    $parent = $faker->randomElement($credentials);

    return [
        'name' => make_json($faker->name),
        'type' => $faker->word,
        'date' => $faker->dateTimeBetween(),
        'archive_no' => $faker->word,
        'place' => $faker->word,
        'parent_id' => ($parent % 2) ? $parent : null,
        'url'=>$faker->word,
        'division_id'=>$faker->randomElement($divisions),
        'department_id'=>$faker->randomElement($departments),
    ];
});
