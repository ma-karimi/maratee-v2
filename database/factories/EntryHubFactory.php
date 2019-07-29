<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\EntryHub::class, function (Faker $faker) {
    return [
        'location_id' => function () {
            return factory(App\Models\Location::class)->create()->id;
        },
        'entry_id' => function () {
            return factory(App\Models\Entry::class)->create()->id;
        },
        'botanical_id' => function () {
            return factory(App\Models\Botanical::class)->create()->id;
        },
        'organization_id' => function () {
            return factory(App\Models\Organization::class)->create()->id;
        },
    ];
});
