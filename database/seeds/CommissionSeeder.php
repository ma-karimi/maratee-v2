<?php

use Illuminate\Database\Seeder;

class CommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        \App\Models\Commission::query()->truncate();
        factory(\App\Models\Commission::class, 50)->create();
    }
}
