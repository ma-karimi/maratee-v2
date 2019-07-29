<?php

use Illuminate\Database\Seeder;

class BotanicalReproductionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\BotanicalReproduction::class, 50)->create();
    }
}
