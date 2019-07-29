<?php

use Illuminate\Database\Seeder;

class ChemicalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Chemical::class, 50)->create();
    }
}
