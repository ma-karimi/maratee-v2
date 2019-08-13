<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Exchange::class, function (Faker $faker) {
    $herbariums = \App\Models\Herbarium::pluck('id')->toArray();
    $paleontologies = \App\Models\Paleontology::pluck('id')->toArray();
    $departments = \App\Models\Department::pluck('id')->toArray();
    $morphs = [\App\Models\Herbarium::class, \App\Models\Paleontology::class];
    return [
        'send_date' => $faker->dateTimeBetween(),
        'receive_date' => $faker->dateTimeBetween(),
        'description' => make_json($faker->text),
        'send_sheet_no' => $faker->numberBetween(1, 100),
        'send_sample_no' => $faker->numberBetween(1, 100),
        'receive_sheet_no' => $faker->numberBetween(1, 100),
        'receive_sample_no' => $faker->numberBetween(1, 100),
        'send_type' => $faker->word,
        'receive_type' => $faker->word,
        'send_department_id' => $faker->randomElement($departments),
        'receive_department_id' => $faker->randomElement($departments),
        'exchange_type' => $faker->randomElement($morphs),
        'send_id' => $faker->randomElement($herbariums),
        'receive_id' => $faker->randomElement($herbariums),
    ];

});
