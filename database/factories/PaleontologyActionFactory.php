<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\PaleontologyAction::class, function (Faker $faker) {
    return [
        'paleontology_id' => function () {
            return factory(App\Models\Paleontology::class)->create()->id;
        },
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'action_id' => function () {
            return factory(App\Models\Action::class)->create()->id;
        },
        'date' => $faker->dateTimeBetween(),
        'description' => make_json($faker->text),
    ];
});
