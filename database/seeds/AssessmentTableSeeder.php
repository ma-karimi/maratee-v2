<?php

use Illuminate\Database\Seeder;

class evaluationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\evaluation::class, 50)->create();
    }
}
