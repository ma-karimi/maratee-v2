<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TransactionEvidence;
use Faker\Generator as Faker;

$factory->define(TransactionEvidence::class, function (Faker $faker) {
    $transactions = \App\Models\Transaction::pluck('id')->toArray();
    return [
        'transaction_id' => $faker->randomElement($transactions),
        'src' => $faker->url,
        'src_description' => $faker->word
    ];
});
