<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\TreatmentHub::class, function (Faker $faker) {
    $treatmentables = \App\Models\Treatment::pluck('id')->toArray();
    return [
        'treatmentable_type'=>$faker->randomElement([\App\Models\MedicinalPlant::class, \App\Models\Paleontology::class, \App\Models\Botanical::class, \App\Models\CryoBank::class, \App\Models\BioMolecular::class]),
        'treatmentable_id' => $faker->randomElement($treatmentables),
        'treatment_id' => $faker->randomElement($treatmentables)
    ];
});
