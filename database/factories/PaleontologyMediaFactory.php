<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\PaleontologyMedia::class, function (Faker $faker) {
    return [
        'credential_correspondence_id' => function () {
            return factory(App\Models\Credential::class)->create(['type'=>'correspondence'])->id;
        },
        'credential_expense_id' => function () {
            return factory(App\Models\Credential::class)->create(['type'=>'expense'])->id;
        },
        'credential_fair_id' => function () {
            return factory(App\Models\Credential::class)->create(['type'=>'fair'])->id;
        },
        'credential_gift_id' => function () {
            return factory(App\Models\Credential::class)->create(['type'=>'gift'])->id;
        },
        'credential_purchase_id' => function () {
            return factory(App\Models\Credential::class)->create(['type'=>'fair'])->id;
        },
        'exchange_id' => function () {
            return factory(App\Models\Exchange::class)->create()->id;
        },
        'media_id' => function () {
            return factory(App\Models\Media::class)->create()->id;
        },
        'paleontology_id' => function () {
            return factory(App\Models\Paleontology::class)->create()->id;
        },
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
    ];
});
