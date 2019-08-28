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
        ini_set('max_execution_time', 30000);
        ini_set('memory_limit', '2000M');
        $this->call([
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
            CredentialTableSeeder::class,
            ProtectionTableSeeder::class,
            DivisionTableSeeder::class,
            EntryTableSeeder::class,
            GeologyAgeTableSeeder::class,
            IrrigationTableSeeder::class,
            LightingTableSeeder::class,
            MapTableSeeder::class,
            MedicineTableSeeder::class,
            SeedFeatureTableSeeder::class,
            MorphologyTableSeeder::class,
            OrganizationTableSeeder::class,
            GeneralTableSeeder::class,
            OriginalGeneralTableSeeder::class,
            OriginalPropagationTableSeeder::class,
            ProjectTableSeeder::class,
            PropagationTableSeeder::class,
            SoilTableSeeder::class,
            SoilFeatureTableSeeder::class,
            LocationTableSeeder::class,
            AuthorHubTableSeeder::class,
            ClassificationTableSeeder::class,
            LifeFormTableSeeder::class,
            PlantTableSeeder::class,
            TaxonomyTableSeeder::class,
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
            PlantingActionTableSeeder::class,
            ProductTableSeeder::class,
            HerbariumTableSeeder::class,
            MedicinalPlantTableSeeder::class,
            MedicinalPlantConstituentTableSeeder::class,
            MedicinalPlantMorphologyTableSeeder::class,
            MorphAuthorTableSeeder::class,

//            SeedTableSeeder::class,
//            BioMolecularTableSeeder::class,
//            SeedExchangeTableSeeder::class,
//            SeedTechnologyTableSeeder::class,
//            SeedWeightTableSeeder::class,
//            SeedHubSeeder::class,
//            SoilHasSoilFeatureTableSeeder::class,
//            CryoBankTableSeeder::class,
//            HerbariumAppendixTableSeeder::class,
//            MediaTableSeeder::class,
//
//            BorrowTableSeeder::class,
//
//            EntryHubTableSeeder::class,
//            ExchangeTableSeeder::class,
//            GardenTableSeeder::class,
//            ChromosomeTableSeeder::class,
//            BotanicalTableSeeder::class,
//            BotanicalGardenActionTableSeeder::class,
//            BotanicalPropagationTableSeeder::class,
//            BotanicalIrrigationTableSeeder::class,
//            MedicalTableSeeder::class,
//            PlantApplicationTableSeeder::class,
//
//            TechnologyCollectionTableSeeder::class,
//            VisitTableSeeder::class,
//            RoleTableSeeder::class,
//            GroupTableSeeder::class,
//            TableTableSeeder::class,
//            TransitionTableSeeder::class,
//            PermissionTableSeeder::class,
//            TransitionTableSeeder::class,
//            ComponentTableSeeder::class,
//            MedicalComponentTableSeeder::class,
        ]);
        Model::reguard();

    }
}
