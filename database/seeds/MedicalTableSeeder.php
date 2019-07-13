<?php

use Illuminate\Database\Seeder;

class MedicalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Medical::class, 50)->create();
    }
}
