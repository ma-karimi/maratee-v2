<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\{Constituent, ConstituentType, MedicinalPlant};
use Faker\Generator as Faker;

$factory->define(App\Models\MedicinalPlantConstituent::class, function (Faker $faker) {

    $types = ConstituentType::pluck('id')->toArray();
    $constituents = Constituent::pluck('id')->toArray();
    $medicinal_plants = MedicinalPlant::pluck('id')->toArray();
    return [
        'medicinal_plant_id' => $faker->randomElement($medicinal_plants),
        'constituent_id' => $faker->randomElement($constituents),
        'constituent_type_id' => $faker->randomElement($types),
        'value' => $faker->randomFloat(2, 0,99),
    ];
});
