<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Media::class, function (Faker $faker) {
    $users = \App\Models\User::pluck('id')->toArray();
    $locations = \App\Models\Location::pluck('id')->toArray();
   // dd($faker->randomElement([\App\Models\Herbarium::class, \App\Models\Paleontology::class, \App\Models\Product::class, \App\Models\Botanical::class, \App\Models\Article::class, \App\Models\Action::class, \App\Models\Chromosome::class, \App\Models\Seed::class, \App\Models\CryoBank::class,\App\Models\Transaction::class, \App\Models\Garden::class]));
    return [
        'name' => $faker->name,
        //'src' => $faker->word,
        'date' => $faker->date(),
        'user_id' => $faker->randomElement($users),
        'location_id' => $faker->randomElement($locations),
        'description' => make_json($faker->text),
        'model_id'=>$faker->numberBetween(1,10),
        'model_type'=>$faker->randomElement([\App\Models\Herbarium::class, \App\Models\Paleontology::class, \App\Models\Product::class, \App\Models\Botanical::class, \App\Models\Article::class, \App\Models\Action::class, \App\Models\Chromosome::class, \App\Models\Seed::class, \App\Models\CryoBank::class,\App\Models\Transaction::class, \App\Models\InternalHabitat::class]),
        'reference' => make_json($faker->word),
        'collection_name' => $faker->name,
        'file_name' => $faker->name,
        'disk' => $faker->word,
        'size' => $faker->numberBetween(100,1000),
        //'manipulations' => make_json($faker->text),
        //'custom_properties' => make_json($faker->text),
        //'responsive_images' => make_json($faker->text),
    ];
});
