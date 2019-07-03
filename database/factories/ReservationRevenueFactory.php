<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\ReservationRevenue::class, function (Faker $faker) {
    return [
        'provider_id'=>$faker->numberBetween(16,18),
        'reserve_id'=>$faker->numberBetween(16,18),
        'revenue_amount'=>$faker->numberBetween(1000,50000),
        'subscription_package_id'=>$faker->numberBetween(1,5),
        'commission_rate'=>$faker->numberBetween(0,100),
        'date'=>$faker->date()

    ];
});
