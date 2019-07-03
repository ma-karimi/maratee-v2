<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        \Illuminate\Support\Facades\DB::table('products')->truncate();
        \Illuminate\Support\Facades\DB::table('product_prices')->truncate();

        // $this->call(UsersTableSeeder::class);
//        $this->call(CommissionSeeder::class);
//        $this->call(ServiceSeeder::class);
//        $this->call(ReservationRevenueSeeder::class);
//        $this->call(ProductSeeder::class);
        $this->call(ProductPriceSeeder::class);
    }
}
