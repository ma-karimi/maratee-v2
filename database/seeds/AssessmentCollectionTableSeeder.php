<?php

use Illuminate\Database\Seeder;

class AssessmentCollectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\AssessmentCollection::class, 50)->create();
    }
}
