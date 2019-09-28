<?php

use Illuminate\Database\Seeder;

class AuthorHubTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ActorHub::class, 50)->create();
    }
}
