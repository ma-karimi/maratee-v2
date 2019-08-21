<?php

use Illuminate\Database\Seeder;

class TransferTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Transfer::class, 50)->create();
        factory(App\Models\TransferMedia::class, 50)->create();
    }
}
