<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Media::class, function (Faker $faker) {
    $users = \App\Models\User::pluck('id')->toArray();
    $herbariums = \App\Models\Herbarium::pluck('id')->toArray();
    $locations = \App\Models\Location::pluck('id')->toArray();
    $seeds = \App\Models\Seed::pluck('id')->toArray();
    $paleontologies = \App\Models\Paleontology::pluck('id')->toArray();
    $medicinal_plants = \App\Models\MedicinalPlant::pluck('id')->toArray();
    $products = \App\Models\Product::pluck('id')->toArray();
    $botanicals = \App\Models\Botanical::pluck('id')->toArray();
    return [
        'name' => make_json($faker->name),
        'format_type' => $faker->word,
        'date' => $faker->dateTimeBetween(),
        'user_id' => $faker->randomElement($users),
        'location_id' => $faker->randomElement($locations),
        'description' => make_json($faker->text),
        'herbarium_id' => $faker->randomElement($herbariums),
        'seed_id' => $faker->randomElement($seeds),
        'paleontology_id' => $faker->randomElement($paleontologies),
        'info_type' => make_json($faker->word),
        'reference' => make_json($faker->word),
        'medicinal_plant_id' => $faker->randomElement($medicinal_plants),
        'product_id' => $faker->randomElement($products),
        'botanical_id' => $faker->randomElement($botanicals),
    ];
});
