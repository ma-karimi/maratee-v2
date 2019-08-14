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
//            SeedFeatureTableSeeder::class,
            MorphologyTableSeeder::class,
            OrganizationTableSeeder::class,
            GeneralTableSeeder::class,
            ProjectTableSeeder::class,
            PropagationTableSeeder::class,
            SoilTableSeeder::class,
            SoilFeatureTableSeeder::class,
            LocationTableSeeder::class,
            TaxonomyTableSeeder::class,
            AuthorHubTableSeeder::class,
            ClassificationTableSeeder::class,
            PlantTableSeeder::class,
//
//            PaleontologyTableSeeder::class,
//
//
//
//            TreatmentTableSeeder::class,
//            MethodTableSeeder::class,

        ]);
        $this->call([
//            LocalityTableSeeder::class,
//            ActionHubTableSeeder::class,
//            ConnectionTableSeeder::class,
//
//            PlantingActionTableSeeder::class,
//
//            HerbariumTableSeeder::class,
//            ProductTableSeeder::class,
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
//            MedicinalPlantTableSeeder::class,
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
//            MedicinalPlantConstituentTableSeeder::class,
//            MedicinalPlantMorphologyTableSeeder::class,
//            PlantApplicationTableSeeder::class,
//
//            TechnologyCollectionTableSeeder::class,
//            VisitTableSeeder::class,
//            RoleTableSeeder::class,
//            GroupTableSeeder::class,
//            TableTableSeeder::class,
//            TransitionTableSeeder::class,
//            PermissionTableSeeder::class,
//            MorphAuthorTableSeeder::class,
//            TransitionTableSeeder::class,
//            ComponentTableSeeder::class,
//            MedicalComponentTableSeeder::class,
//            MedicinalPlantMethodTableSeeder::class,
        ]);
        Model::reguard();

    }
}
