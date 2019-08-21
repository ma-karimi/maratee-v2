<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\TransferMedia::class, function (Faker $faker) {
    $medias = \App\Models\Media::pluck('id')->toArray();
    $transfers = \App\Models\Transfer::pluck('id')->toArray();
    return [
        'media_id' => $faker->randomElement($medias),
        'transfer_id' => $faker->randomElement($transfers)
    ];
});
