<?php

use Illuminate\Database\Seeder;

class ReproductionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Reproduction::class, 50)->create();
    }
}
