<?php

use Illuminate\Database\Seeder;

class EntryHubTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\EntryHub::class, 50)->create();
    }
}
