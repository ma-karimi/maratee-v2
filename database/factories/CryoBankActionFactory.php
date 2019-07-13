<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\CryoBankAction::class, function (Faker $faker) {
    return [
        'cryo_bank_id' => function () {
            return factory(App\Models\CryoBank::class)->create()->id;
        },
        'action_id' => function () {
            return factory(App\Models\Action::class)->create()->id;
        },
    ];
});
