<?php

use Illuminate\Database\Seeder;

class ConstituentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Constituent::class, 50)->create();
    }
}
