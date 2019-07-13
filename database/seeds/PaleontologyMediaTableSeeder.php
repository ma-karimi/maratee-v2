<?php

use Illuminate\Database\Seeder;

class PaleontologyMediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\PaleontologyMedia::class, 50)->create();
    }
}
