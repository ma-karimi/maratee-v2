<?php

use Illuminate\Database\Seeder;

class CryoBankActionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\CryoBankAction::class, 50)->create();
    }
}
