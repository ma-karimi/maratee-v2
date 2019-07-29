<?php

use Illuminate\Database\Seeder;

class CryoBankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\CryoBank::class, 50)->create();
    }
}
