<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Media::class, function (Faker $faker) {
    $users = \App\Models\User::pluck('id')->toArray();
    $herbariums = \App\Models\Herbarium::pluck('id')->toArray();
    $locations = \App\Models\Location::pluck('id')->toArray();
    return [
        'name' => make_json($faker->name),
        'src' => $faker->word,
        'format_type' => $faker->word,
        'date' => $faker->dateTimeBetween(),
        'user_id' => $faker->randomElement($users),
        'location_id' => $faker->randomElement($locations),
        'description' => make_json($faker->text),
        'mediable_id'=>$faker->randomElement($herbariums),
        'mediable_type'=>$faker->randomElement([\App\Models\Herbarium::class, \App\Models\Paleontology::class, \App\Models\Product::class, \App\Models\Botanical::class, \App\Models\Article::class, \App\Models\Action::class, \App\Models\Chromosome::class, \App\Models\Seed::class, \App\Models\CryoBank::class, \App\Models\Garden::class]),
        'info_type' => make_json($faker->word),
        'reference' => make_json($faker->word),
    ];
});
