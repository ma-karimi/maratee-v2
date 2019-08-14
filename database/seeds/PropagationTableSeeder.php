<?php

use Illuminate\Database\Seeder;

class PropagationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Propagation::class, 50)->create();
    }
}
