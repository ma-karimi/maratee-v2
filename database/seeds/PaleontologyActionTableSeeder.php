<?php

use Illuminate\Database\Seeder;

class PaleontologyActionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\PaleontologyAction::class, 50)->create();
    }
}
