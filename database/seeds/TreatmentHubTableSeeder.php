<?php

use Illuminate\Database\Seeder;

class TreatmentHubTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\TreatmentHub::class, 50)->create();
    }
}
