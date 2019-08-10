<?php

use Illuminate\Database\Seeder;

class TransferCredentialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\TransferCredential::class, 50)->create();
    }
}
