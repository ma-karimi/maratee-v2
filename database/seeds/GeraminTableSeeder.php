<?php

use Illuminate\Database\Seeder;

class GeraminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Geramin::class, 50)->create();
    }
}
