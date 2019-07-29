<?php

use Illuminate\Database\Seeder;

class HerbariumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Herbarium::class, 50)->create();
    }
}
