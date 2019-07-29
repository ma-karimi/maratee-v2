<?php

use Illuminate\Database\Seeder;

class IrrigationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Irrigation::class, 50)->create();
    }
}
