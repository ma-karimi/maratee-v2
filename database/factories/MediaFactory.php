<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Media::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'format_type' => $faker->word,
        'date' => $faker->dateTimeBetween(),
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'location_id' => function () {
            return factory(App\Models\Location::class)->create()->id;
        },
        'description' => make_json($faker->text),
        'herbarium_id' => function () {
            return factory(App\Models\Herbarium::class)->create()->id;
        },
        'seed_id' => function () {
            return factory(App\Models\Seed::class)->create()->id;
        },
        'paleontology_id' => function () {
            return factory(App\Models\Paleontology::class)->create()->id;
        },
        'info_type' => make_json($faker->word),
        'reference' => make_json($faker->word),
        'medicinal_plant_id' => function () {
            return factory(App\Models\MedicinalPlant::class)->create()->id;
        },
        'product_id' => function () {
            return factory(App\Models\Product::class)->create()->id;
        },
        'botanical_id' => function () {
            return factory(App\Models\Botanical::class)->create()->id;
        },
    ];
});
