<?php

use Illuminate\Database\Seeder;
use PragmaRX\Countries\Package\Countries;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //  factory(App\Models\City::class, 50)->create();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \Illuminate\Support\Facades\DB::table('cities')->truncate();
        $countries = new Countries();
        $iran_cities=$countries->where('name.common', 'Iran')
            ->first()->hydrateCities()
            ->cities;
        foreach ($iran_cities as $index => $iran_city) {
            $state_name=$iran_city['adm1name'];
            $province_id=\App\Models\Province::where('name->en','LIKE',"%$state_name%")->first();
            if(!empty($province_id)){
                \App\Models\City::create([
                    'name' => ['en' => $index],
                    'province_id' =>!empty($province_id)?$province_id->id:null
                ]);
            }
        }
    }
}
