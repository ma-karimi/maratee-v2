<?php

use Illuminate\Database\Seeder;

class ActionHubTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ActionHub::class, 50)->create();
    }
}
