<?php

use Illuminate\Database\Seeder;

class PaleontologyCitationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\PaleontologyCitation::class, 50)->create();
    }
}
