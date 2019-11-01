<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {

    $users = \App\Models\User::pluck('id')->toArray();
    $organizations = \App\Models\Organization::pluck('id')->toArray();
    $paleontologies = \App\Models\Paleontology::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($users),
        'organization_id' => $faker->randomElement($organizations),
        'transactionable_type' => $faker->randomElement([\App\Models\PlantHerbarium::class, \App\Models\Paleontology::class]),
        'transactionable_id' => $faker->randomElement($paleontologies),
        'start_time' => $faker->dateTime,
        'type_id' => $type = $faker->numberBetween(1,7),
        'archive_no' => $faker->word,
        'description' => $faker->word,
        'purpose' => $faker->word,
        'visit_id' => $type == 1 ? $faker->numberBetween(1,2) : null,
        'mode_id' => $type == 3 ? $faker->numberBetween(1,2) : null,
        'peoples_no' => $faker->numberBetween(1,50),
        'person_position' => $faker->word,
        'sheets_no' => $faker->numberBetween(1,100),
    ];
});
