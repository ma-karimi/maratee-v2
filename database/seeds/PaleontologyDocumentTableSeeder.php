<?php

use Illuminate\Database\Seeder;

class PaleontologyDocumentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\PaleontologyDocument::class, 50)->create();
    }
}
