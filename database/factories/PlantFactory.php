<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Plant::class, function (Faker $faker) {
    $authors=\App\Models\Author::pluck('id')->toArray();
    $articles=\App\Models\Article::pluck('id')->toArray();
    $users=\App\Models\User::pluck('id')->toArray();
    $locations=\App\Models\Location::pluck('id')->toArray();
    $plant_class_generals=\App\Models\PlantGeneral::where('type','class')->pluck('id')->toArray();
    $plant_family_generals=\App\Models\PlantGeneral::where('type','family')->pluck('id')->toArray();
    $plant_flowering_generals=\App\Models\PlantGeneral::where('type','flowering')->pluck('id')->toArray();
    $plant_genus_generals=\App\Models\PlantGeneral::where('type','genus')->pluck('id')->toArray();
    $plant_group_generals=\App\Models\PlantGeneral::where('type','group')->pluck('id')->toArray();
    $plant_order_generals=\App\Models\PlantGeneral::where('type','order')->pluck('id')->toArray();
    $plant_specie_generals=\App\Models\PlantGeneral::where('type','specie')->pluck('id')->toArray();
    $plant_sperm_generals=\App\Models\PlantGeneral::where('type','sperm')->pluck('id')->toArray();
    $plant_sub_specie_generals=\App\Models\PlantGeneral::where('type','sub_specie')->pluck('id')->toArray();
    $plant_variety_generals=\App\Models\PlantGeneral::where('type','variety')->pluck('id')->toArray();
    $plant_cotyledon_generals=\App\Models\PlantGeneral::where('type','cotyledon')->pluck('id')->toArray();
    return [
        'name' => make_json($faker->word),
        'domestic_name' => make_json($faker->word),
        'description' => make_json($faker->text),
        'author_id' => $faker->randomElement($authors),
        'article_id' => $faker->randomElement($articles),
        'user_id' =>$faker->randomElement($users),
        'location_id' => $faker->randomElement($locations),
        'plant_general_class_id' => $faker->randomElement($plant_class_generals),
        'plant_general_family_id' => $faker->randomElement($plant_family_generals),
        'plant_general_flowering_id' => $faker->randomElement($plant_flowering_generals),
        'plant_general_genus_id' => $faker->randomElement($plant_genus_generals),
        'plant_general_group_id' => $faker->randomElement($plant_group_generals),
        'plant_general_order_id' => $faker->randomElement($plant_order_generals),
        'plant_general_specie_id' => $faker->randomElement($plant_specie_generals),
        'plant_general_sperm_id' =>$faker->randomElement($plant_sperm_generals),
        'plant_general_sub_specie_id' => $faker->randomElement($plant_sub_specie_generals),
        'plant_general_variety_id' => $faker->randomElement($plant_variety_generals),
        'plant_general_cotyledon_id' => count($plant_cotyledon_generals) ? $faker->randomElement($plant_cotyledon_generals) : null,
    ];
});
