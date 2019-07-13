<?php

use Illuminate\Database\Seeder;

class MorphologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Morphology::class, 50)->create();
    }
}
