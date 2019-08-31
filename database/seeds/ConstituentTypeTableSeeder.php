<?php

use Illuminate\Database\Seeder;

class ConstituentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ConstituentType::class, 50)->create();
    }
}
