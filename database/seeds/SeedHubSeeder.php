<?php

use Illuminate\Database\Seeder;

class SeedHubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\SeedHub::class, 50)->create();
    }
}
