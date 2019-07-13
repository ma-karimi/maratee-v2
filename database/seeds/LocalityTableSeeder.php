<?php

use Illuminate\Database\Seeder;

class LocalityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Locality::class, 50)->create();
    }
}
