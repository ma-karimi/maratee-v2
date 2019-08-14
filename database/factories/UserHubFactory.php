<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\UserHub::class, function (Faker $faker) {
    $userables = \App\Models\User::pluck('id')->toArray();
    return [
        'userable_type'=>$faker->randomElement([\App\Models\Plant::class, \App\Models\CryoBank::class, \App\Models\Media::class, \App\Models\SeedHub::class, \App\Models\Technology::class, \App\Models\Article::class]),
        'userable_id' => $faker->randomElement($userables)
    ];
});
