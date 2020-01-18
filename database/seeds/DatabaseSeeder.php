<?php

use App\Models\{Country, User};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Utility::truncateTables();

        Model::unguard();
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');

        $this->call([
            CountryTableSeeder::class,
            ProvinceTableSeeder::class,
            OriginalGeneralTableSeeder::class,
            OriginalPropagationTableSeeder::class,
            OriginalMedicinalPlantTypeTableSeeder::class,
            OriginalMethodTableSeeder::class,
            MedicinalPartTableSeeder::class,
            ProtectionTableSeeder::class,
            LifeFormTableSeeder::class,
            OriginalSeedGeneralTableSeeder::class,
            OriginalBotanicalGeneralTableSeeder::class,
            ConvertSeeder::class,

        ]);
        Model::reguard();
    }
}
