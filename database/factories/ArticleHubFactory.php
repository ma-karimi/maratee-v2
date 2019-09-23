<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\ArticleHub::class, function (Faker $faker) {
    $articles = \App\Models\Article::pluck('id')->toArray();
    return [
        'article_id' => $faker->randomElement($articles),
        'articleable_id' => $faker->randomElement($articles),
        'articleable_type' => $faker->randomElement([\App\Models\CryoBank::class, \App\Models\Media::class, \App\Models\ActionHub::class, \App\Models\PlantHerbarium::class, \App\Models\Chromosome::class, \App\Models\MedicinalPlant::class, \App\Models\Paleontology::class]),
    ];
});
