<?php

use Illuminate\Database\Seeder;

class BotanicalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Botanical::class, 50)->create();
    }
}
