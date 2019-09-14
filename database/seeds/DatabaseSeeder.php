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
            ProductTableSeeder::class,
            HerbariumTableSeeder::class,
            MedicinalPlantTableSeeder::class,
            MedicinalPlantConstituentTableSeeder::class,
            MorphAuthorTableSeeder::class,
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
            ChromosomeTableSeeder::class,
            CryoBankTableSeeder::class,

//            SeedTableSeeder::class,
//            BioMolecularTableSeeder::class,
//            SeedExchangeTableSeeder::class,
//            HerbariumAppendixTableSeeder::class,
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
        Model::reguard();

    }
}
