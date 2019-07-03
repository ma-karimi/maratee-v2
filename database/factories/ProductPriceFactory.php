<?php

use Faker\Generator as Faker;

$sellers = \App\Models\Seller::pluck('id')->toArray();
$products = \App\Models\Product::pluck('id')->toArray();


$factory->define(\App\Models\ProductPrice::class, function (Faker $faker) use ($products, $sellers) {
    return [
        'in_stock' => $faker->randomDigit,
        'seller_id' => $faker->randomElement($sellers),
        'product_id' => $faker->randomElement($products),
        'price' => $faker->randomNumber(),
    ];
});
