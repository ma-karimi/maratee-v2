<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BiochemicalEvaluation;
use Faker\Generator as Faker;

$factory->define(BiochemicalEvaluation::class, function (Faker $faker) {

    $organizations = \App\Models\Organization::pluck('id')->toArray();
    return [
        'organization_id' => $faker->randomElement($organizations),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
