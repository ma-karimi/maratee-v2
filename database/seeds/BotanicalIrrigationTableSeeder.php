<?php

use Illuminate\Database\Seeder;

class BotanicalIrrigationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\BotanicalIrrigation::class, 50)->create();
    }
}
