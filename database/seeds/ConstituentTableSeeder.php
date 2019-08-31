<?php

use App\Models\Constituent;
use Illuminate\Database\Seeder;

class ConstituentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(App\Models\Constituent::class, 50)->create();

        for ($i = 0; $i < 11; $i++) {
            Constituent::create([
                'name' => ['en' => "constituent{$i}"]
            ]);
        }
    }
}
