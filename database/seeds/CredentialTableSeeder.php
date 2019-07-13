<?php

use Illuminate\Database\Seeder;

class CredentialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Credential::class, 50)->create();
    }
}
