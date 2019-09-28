<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\General;
use App\Models\Herbarium;
use App\Models\MedicinalPart;
use App\Models\MedicinalPlant;
use App\Models\MedicinalPlantType;
use App\Models\Medicine;
use App\Models\Method;
use App\Models\PlantHerbarium;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(App\Models\MedicinalPlant::class, function (Faker $faker) {
    $plants = PlantHerbarium::pluck('id')->toArray();
    $taxonomies = \App\Models\Taxonomy::pluck('id')->toArray();
    $locations = \App\Models\Location::pluck('id')->toArray();
    $aerial_parts = MedicinalPart::whereType(1)->pluck('id')->toArray();
    $ground_parts = MedicinalPart::whereType(2)->pluck('id')->toArray();
    $food_industries = MedicinalPlantType::whereTypeId(1)->pluck('id')->toArray();
    $hygienic_cosmetic_industries = MedicinalPlantType::whereTypeId(2)->pluck('id')->toArray();
    $industrial_potentials = MedicinalPlantType::whereTypeId(3)->pluck('id')->toArray();
    $general_phenology = General::whereType('phenology')->pluck('id')->toArray();
    $methods = Method::pluck('id')->toArray();
    $medicines = Medicine::pluck('id')->toArray();
    $secondary_metabolites = MedicinalPlantType::whereTypeId(5)->pluck('id')->toArray();
    $effective_materials = MedicinalPlantType::whereTypeId(6)->pluck('id')->toArray();
    $products = Product::pluck('id')->toArray();
    return [
        'plant_herbarium_id' => $faker->randomElement($plants),
        'taxonomy_id' => $faker->randomElement($taxonomies),
        'location_id' => $faker->randomElement($locations),
        'aerial_part_id' => $faker->randomElement($aerial_parts),
        'ground_part_id' => $faker->randomElement($ground_parts),
        'food_industry_id' => $faker->randomElement($food_industries),
        'hygienic_cosmetic_industry_id' => $faker->randomElement($hygienic_cosmetic_industries),
        'industrial_potential_id' => $faker->randomElement($industrial_potentials),
        'general_phenology_id' => $faker->randomElement($general_phenology),
        'method_distillation_id' => $faker->randomElement($methods),
        'method_extraction_id' => $faker->randomElement($methods),
        'method_analyse_id' => $faker->randomElement($methods),
        'secondary_metabolite_id' => $faker->randomElement($secondary_metabolites),
        'effective_material_id' => $faker->randomElement($effective_materials),
        'product_id' => $faker->randomElement($products),
        'traditional_iranian_medicine' =>array_rand(MedicinalPlant::TRADITIONAL_IRANIAN_MEDICINE) ,
        'natural_drug' =>array_rand(MedicinalPlant::NATURAL_DRUG) ,
        'inherbal_medicine_store' =>array_rand(MedicinalPlant::INHERBAL_MEDICINE_STORE) ,
        'exporting' =>array_rand(MedicinalPlant::EXPORTING) ,
        'importing' =>array_rand(MedicinalPlant::IMPORTING) ,
        'cultivated_area' =>array_rand(MedicinalPlant::CULTIVATED_AREA) ,
        'studied_sample' =>array_rand(MedicinalPlant::STUDIED_SAMPLE) ,
        'presence_in_country' =>array_rand(MedicinalPlant::PRESENCE_IN_COUNTRY) ,
        'medicine_id' =>$faker->randomElement($medicines) ,
        'code_no' =>$faker->numberBetween(1,100),
        'flower_color' =>make_json($faker->word),
        'fruit_color' =>make_json($faker->word),
        'height' =>random_int(1,100).'-'.random_int(100,200),
    ];
});
