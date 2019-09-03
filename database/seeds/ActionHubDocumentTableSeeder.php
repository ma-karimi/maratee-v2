<?php

use Illuminate\Database\Seeder;

class ActionHubDocumentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ActionHubDocument::class, 50)->create();
    }
}
