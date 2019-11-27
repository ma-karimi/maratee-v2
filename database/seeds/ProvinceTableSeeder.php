<?php

use Illuminate\Database\Seeder;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\Models\Province::class, 50)->create();
        if (DB::getDefaultConnection() !== 'pgsql') {
            \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }
        \Illuminate\Support\Facades\DB::table('provinces')->truncate();
        $countries = new \PragmaRX\Countries\Package\Countries();
        $states=$countries->where('name.common', 'Iran')
            ->first()
            ->hydrateStates()
            ->states
            ->sortBy('name')
            ->pluck('name', 'postal');
        foreach ($states as $index => $item) {
            \App\Models\Province::create([
                'name_en' => $item,
                'country_id' => 109
            ]);
        }

    }
}
