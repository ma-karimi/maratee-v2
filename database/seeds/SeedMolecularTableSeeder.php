<?php

use Illuminate\Database\Seeder;

class SeedMolecularTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\SeedMolecular::class, 50)->create();
    }
}
