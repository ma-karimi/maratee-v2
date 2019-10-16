<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

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

        \App\Models\Country::create([
            'name' => ['en'=>'Iran','fa'=>'ایران']
        ]);
        $this->call([
          /* (new ConvertSeeder(0, 5000))->run(),
            (new ConvertSeeder(5000, 10000))->run(),
            (new ConvertSeeder(10000, 15000))->run(),
            (new ConvertSeeder(15000, 20000))->run(),
            (new ConvertSeeder(20000, 25000))->run(),
            (new ConvertSeeder(25000, 30000))->run(),
            (new ConvertSeeder(30000, 35000))->run(),
            (new ConvertSeeder(35000, 40000))->run(),
            (new ConvertSeeder(40000, 45000))->run(),
            (new ConvertSeeder(45000, 50000))->run(),
            (new ConvertSeeder(50000, 55000))->run(),
            (new ConvertSeeder(55000, 65000))->run(),*/
            UserTableSeeder::class,
            ContinentTableSeeder::class,
            CountryTableSeeder::class,
            ProvinceTableSeeder::class,
            CityTableSeeder::class,
            VillageTableSeeder::class,
            ActionTableSeeder::class,
            EvaluationTableSeeder::class,
            AuthorTableSeeder::class,
            ArticleTableSeeder::class,
            CollectionTableSeeder::class,
            ConstituentTableSeeder::class,
            DepartmentTableSeeder::class,
            ProtectionTableSeeder::class,
            DivisionTableSeeder::class,
            EntryTableSeeder::class,
            GeologyAgeTableSeeder::class,
            IrrigationTableSeeder::class,
            LightingTableSeeder::class,
            MapTableSeeder::class,
            MedicineTableSeeder::class,
            ConstituentTypeTableSeeder::class,
            SeedFeatureTableSeeder::class,
            OrganizationTableSeeder::class,
            GeneralTableSeeder::class,
            OriginalGeneralTableSeeder::class,
            OriginalPropagationTableSeeder::class,
            ProjectTableSeeder::class,
            PropagationTableSeeder::class,
            SoilTableSeeder::class,
            LocationTableSeeder::class,
            AuthorHubTableSeeder::class,
            LifeFormTableSeeder::class,
            TaxonomyTableSeeder::class,
            PlantHerbariumTableSeeder::class,
            PlantLifeFormTableSeeder::class,
            PaleontologyTableSeeder::class,
            TreatmentTableSeeder::class,
            TreatmentHubTableSeeder::class,
            MethodTableSeeder::class,
            PlantPropertyTableSeeder::class,
        ]);
        $this->call([
            MedicinalPartTableSeeder::class,
            LocalityTableSeeder::class,
            ActionHubTableSeeder::class,
            ProductTableSeeder::class,
            HerbariumTableSeeder::class,
            MedicinalPlantTableSeeder::class,
            MedicinalPlantConstituentTableSeeder::class,
            TransactionTableSeeder::class,
            TransactionEvidenceTableSeeder::class,
            PaleontologyDocumentTableSeeder::class,
            PaleontologyCitationTableSeeder::class,
            ActionHubDocumentTableSeeder::class,
            MedicinalPlantTableSeeder::class,
            MedicinalPlantTypeTableSeeder::class,
            BotanicalTableSeeder::class,
            BotanicalIrrigationTableSeeder::class,
            BotanicalOperationTableSeeder::class,
            MediaTableSeeder::class,
            ChromosomeTableSeeder::class,
            CryoBankTableSeeder::class,
            LocationHubTableSeeder::class,
            PermissionTableSeeder::class,

//            SeedTableSeeder::class,
//            BioMolecularTableSeeder::class,
//            SeedExchangeTableSeeder::class,
//            SeedTechnologyTableSeeder::class,
//            SeedWeightTableSeeder::class,
//            SeedHubSeeder::class,
//            HerbariumAppendixTableSeeder::class,
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

        Model::reguard();
    }
}
