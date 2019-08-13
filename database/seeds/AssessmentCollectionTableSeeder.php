<?php

use Illuminate\Database\Seeder;

class evaluationCollectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\evaluationCollection::class, 50)->create();
    }
}
