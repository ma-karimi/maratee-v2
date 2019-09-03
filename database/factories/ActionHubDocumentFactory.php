<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ActionHubDocument;
use Faker\Generator as Faker;

$factory->define(ActionHubDocument::class, function (Faker $faker) {
    $action_hubs = \App\Models\ActionHub::pluck('id')->toArray();
    return [
        'action_hub_id' => $faker->randomElement($action_hubs),
        'src' => $faker->url,
        'src_description' => $faker->word
    ];
});
