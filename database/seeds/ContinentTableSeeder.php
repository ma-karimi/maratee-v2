<?php

use Illuminate\Database\Seeder;

class ContinentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Models\Continent::class, 50)->create();
        \Illuminate\Support\Facades\DB::table('continents')->truncate();
        $continents_name=['Asia','Africa','Europe','Oceania','Antarctica','North America','South America'];
        foreach ($continents_name as $index => $item) {
            \App\Models\Continent::create([
                'name'=>$item
            ]);
        }
    }
}
