<?php

use Illuminate\Database\Seeder;

class TransitionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Transition::class, 50)->create();
    }
}
