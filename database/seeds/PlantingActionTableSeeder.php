<?php

use Illuminate\Database\Seeder;

class PlantingActionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\PlantingAction::class, 50)->create();
    }
}
