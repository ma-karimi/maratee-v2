<?php

use Illuminate\Database\Seeder;

class BotanicalPropagationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\BotanicalSoil::class, 50)->create();
    }
}
