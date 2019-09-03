<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PaleontologyDocument;
use Faker\Generator as Faker;

$factory->define(PaleontologyDocument::class, function (Faker $faker) {
    $paleontologies = \App\Models\Paleontology::pluck('id')->toArray();
    return [
        'paleontology_id' => $faker->randomElement($paleontologies),
        'src' => $faker->url,
        'src_description' => $faker->word
    ];
});
