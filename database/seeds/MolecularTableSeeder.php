<?php

use Illuminate\Database\Seeder;

class MolecularTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Molecular::class, 50)->create();
    }
}
