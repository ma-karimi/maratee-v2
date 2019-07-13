<?php

use Illuminate\Database\Seeder;

class BotanicalGardenActionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\BotanicalGardenAction::class, 50)->create();
    }
}
