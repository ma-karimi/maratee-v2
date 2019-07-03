<?php

use Illuminate\Database\Seeder;

class ReservationRevenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\ReservationRevenue::class,50)->create();
    }
}
