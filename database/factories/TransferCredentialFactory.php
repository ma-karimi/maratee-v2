<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\TransferCredential::class, function (Faker $faker) {
    $herbariums = \App\Models\Herbarium::pluck('id')->toArray();
    $paleontologies = \App\Models\Paleontology::pluck('id')->toArray();
    $medias = \App\Models\Media::pluck('id')->toArray();
    $credentials = \App\Models\Credential::pluck('id')->toArray();
    $entitiables = [\App\Models\Herbarium::class, \App\Models\Paleontology::class];
    $transferables = [\App\Models\Visit::class, \App\Models\Borrow::class, \App\Models\Exchange::class];
    return [
        'media_id' => $faker->randomElement($medias),
        'credential_id' => $faker->randomElement($credentials),
        'entitiable_type' => \App\Models\Herbarium::class,
        'transferable_type' => \App\Models\Borrow::class,
        'entitiable_id' => $faker->randomElement($herbariums),
        'transferable_id' => $faker->randomElement($herbariums),
    ];
});
