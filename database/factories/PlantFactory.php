<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Plant::class, function (Faker $faker) {
    $authors = \App\Models\Author::pluck('id')->toArray();
    $articles = \App\Models\Article::pluck('id')->toArray();
    $users = \App\Models\User::pluck('id')->toArray();
    $locations = \App\Models\Location::pluck('id')->toArray();
    $plant_class_generals = \App\Models\General::where('type', 'class')->pluck('id')->toArray();
    $plant_family_generals = \App\Models\General::where('type', 'family')->pluck('id')->toArray();
    $plant_flowering_generals = \App\Models\General::where('type', 'flowering')->pluck('id')->toArray();
    $plant_genus_generals = \App\Models\General::where('type', 'genus')->pluck('id')->toArray();
    $plant_group_generals = \App\Models\General::where('type', 'group')->pluck('id')->toArray();
    $plant_order_generals = \App\Models\General::where('type', 'order')->pluck('id')->toArray();
    $plant_specie_generals = \App\Models\General::where('type', 'specie')->pluck('id')->toArray();
    $plant_sperm_generals = \App\Models\General::where('type', 'sperm')->pluck('id')->toArray();
    $plant_sub_specie_generals = \App\Models\General::where('type', 'sub_specie')->pluck('id')->toArray();
    $plant_variety_generals = \App\Models\General::where('type', 'variety')->pluck('id')->toArray();
    $plant_cotyledon_generals = \App\Models\General::where('type', 'cotyledon')->pluck('id')->toArray();
    return [
        'name' => make_json($faker->word),
        'domestic_name' => make_json($faker->word),
        'description' => make_json($faker->text),
        'author_id' => $faker->randomElement($authors),
        'article_id' => $faker->randomElement($articles),
        'user_id' => $faker->randomElement($users),
        'location_id' => $faker->randomElement($locations),
        'general_class_id' => count($plant_class_generals) ? $faker->randomElement($plant_class_generals) : null,
        'general_family_id' => count($plant_family_generals) ? $faker->randomElement($plant_family_generals) : null,
        'general_flowering_id' => count($plant_flowering_generals) ? $faker->randomElement($plant_flowering_generals) : null,
        'general_genus_id' => count($plant_genus_generals) ? $faker->randomElement($plant_genus_generals) : null,
        'general_group_id' => count($plant_group_generals) ? $faker->randomElement($plant_group_generals) : null,
        'general_order_id' => count($plant_order_generals) ? $faker->randomElement($plant_order_generals) : null,
        'general_specie_id' => count($plant_specie_generals) ? $faker->randomElement($plant_specie_generals) : null,
        'general_sperm_id' => count($plant_sperm_generals) ? $faker->randomElement($plant_sperm_generals) : null,
        'general_sub_specie_id' => count($plant_sub_specie_generals) ? $faker->randomElement($plant_sub_specie_generals) : null,
        'general_variety_id' => count($plant_variety_generals) ? $faker->randomElement($plant_variety_generals) : null,
        'general_cotyledon_id' => count($plant_cotyledon_generals) ? $faker->randomElement($plant_cotyledon_generals) : null,
    ];
});
