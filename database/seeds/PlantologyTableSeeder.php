<?php

use Illuminate\Database\Seeder;

class PlantologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Plantology::class, 50)->create();
    }
}
