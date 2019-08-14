<?php

use Illuminate\Database\Seeder;

class BioMolecularTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\BioMolecular::class, 50)->create();
    }
}
