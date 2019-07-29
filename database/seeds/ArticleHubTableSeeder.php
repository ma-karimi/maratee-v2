<?php

use Illuminate\Database\Seeder;

class ArticleHubTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ArticleHub::class, 50)->create();
    }
}
