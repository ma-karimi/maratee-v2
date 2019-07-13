<?php

use Illuminate\Database\Seeder;

class ProtectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Protection::class, 50)->create();
    }
}
