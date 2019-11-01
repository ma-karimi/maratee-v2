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
//        exec('composer dump-autoload');
        Artisan::call('passport:install --force');

        \App\Utility::truncateTables();

        Model::unguard();
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '-1');
        if (App::environment() == 'production') {
            Country::create([
                'name' => ['en' => 'Iran', 'fa' => 'ایران']
            ]);


            User::create([
                'email' => 'admin@gmail.com',
                'password' => 123456,
                'title' => ['en' => 'mrs.'],
                'education' => ['en' => 'wewewe'],
                'degree' => ['en' => 'ssss'],
                'national_id' => 61,
                'birthday' => '1993-01-20',
                'nationality' => ['en' => 'Colombia'],
                'full_name' => ['en' => 'Camille Swift'],
                'mobile' => '9145508431',
                'phone' => '9145508431',
            ]);

            $this->call([
                OriginalGeneralTableSeeder::class,
                OriginalPropagationTableSeeder::class,
                OriginalMedicinalPlantTypeTableSeeder::class,
                OriginalMethodTableSeeder::class,

//                ConvertSeeder::class,

            ]);

        } else {
            User::create([
                'email' => 'admin@gmail.com',
                'password' => 123456,
                'title' => ['en' => 'mrs.'],
                'education' => ['en' => 'wewewe'],
                'degree' => ['en' => 'ssss'],
                'national_id' => 61,
                'birthday' => '1993-01-20',
                'nationality' => ['en' => 'Colombia'],
                'full_name' => ['en' => 'Camille Swift'],
                'mobile' => '9145508431',
                'phone' => '9145508431',
            ]);
            $this->call([
                OriginalGeneralTableSeeder::class,
                OriginalPropagationTableSeeder::class,
                OriginalMedicinalPlantTypeTableSeeder::class,
                OriginalMethodTableSeeder::class,
                UserTableSeeder::class,
                ContinentTableSeeder::class,
                CountryTableSeeder::class,
                ProvinceTableSeeder::class,
                CityTableSeeder::class,
                VillageTableSeeder::class,
//                ActionTableSeeder::class,
//                EvaluationTableSeeder::class,
                AuthorTableSeeder::class,
                ArticleTableSeeder::class,
                CollectionTableSeeder::class,
                ConstituentTableSeeder::class,
                DepartmentTableSeeder::class,
                ProtectionTableSeeder::class,
                DivisionTableSeeder::class,
                GeologyAgeTableSeeder::class,
                IrrigationTableSeeder::class,
                LightingTableSeeder::class,
                MapTableSeeder::class,
                MedicineTableSeeder::class,
                ConstituentTypeTableSeeder::class,
                OrganizationTableSeeder::class,
                GeneralTableSeeder::class,

                ProjectTableSeeder::class,
                PropagationTableSeeder::class,
                LocationTableSeeder::class,
                LifeFormTableSeeder::class,
                TaxonomyTableSeeder::class,
                PlantHerbariumTableSeeder::class,
                PlantLifeFormTableSeeder::class,
                PaleontologyTableSeeder::class,
                TreatmentTableSeeder::class,
                TreatmentHubTableSeeder::class,
                MethodTableSeeder::class,
//                PlantPropertyTableSeeder::class,
            ]);
            $this->call([
                MedicinalPartTableSeeder::class,
                LocalityTableSeeder::class,
                ActionHubTableSeeder::class,
                ProductTableSeeder::class,
                MedicinalPlantTableSeeder::class,
                MedicinalPlantConstituentTableSeeder::class,
                PaleontologyDocumentTableSeeder::class,
                PaleontologyCitationTableSeeder::class,
                AuthorHubTableSeeder::class,
                TransactionTableSeeder::class,
                TransactionEvidenceTableSeeder::class,

                ActionHubDocumentTableSeeder::class,
                BotanicalTableSeeder::class,
                BotanicalIrrigationTableSeeder::class,
                BotanicalOperationTableSeeder::class,
                MediaTableSeeder::class,
                ChromosomeTableSeeder::class,
                CryoBankTableSeeder::class,
                LocationHubTableSeeder::class,
                PermissionTableSeeder::class,
//                ConvertSeeder::class,

//            SeedTableSeeder::class,
//            BioMolecularTableSeeder::class,
//            SeedExchangeTableSeeder::class,
//            SeedTechnologyTableSeeder::class,
//            SeedWeightTableSeeder::class,
//            SeedHubSeeder::class,
//            GardenTableSeeder::class,
//            MediaTableSeeder::class,
//
//
//            EntryHubTableSeeder::class,
//            BotanicalGardenActionTableSeeder::class,
//            BotanicalPropagationTableSeeder::class,
//            MedicalTableSeeder::class,//
//            TechnologyCollectionTableSeeder::class,
//            RoleTableSeeder::class,
//            GroupTableSeeder::class,
//            TableTableSeeder::class,
//            TransitionTableSeeder::class,
//            PermissionTableSeeder::class,
//            ComponentTableSeeder::class,
//            MedicalComponentTableSeeder::class,
            ]);
        }
        Model::reguard();
    }
}
