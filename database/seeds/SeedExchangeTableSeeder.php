<?php

use Illuminate\Database\Seeder;

class SeedExchangeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\SeedExchange::class, 50)->create();
    }
}
