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
            evaluationTableSeeder::class,
            AuthorTableSeeder::class,
            ArticleTableSeeder::class,
            ChemicalTableSeeder::class,
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
            seedFeatureTableSeeder::class,
            MorphologyTableSeeder::class,
            OrganizationTableSeeder::class,
            GeneralTableSeeder::class,
            ProjectTableSeeder::class,
            PropagationTableSeeder::class,
            SoilTableSeeder::class,
            SoilFeatureTableSeeder::class,
            LocationTableSeeder::class,
            PlantTableSeeder::class,

            PaleontologyTableSeeder::class,



            TreatmentTableSeeder::class,
            MethodTableSeeder::class,

        ]);
        $this->call([
            LocalityTableSeeder::class,
            ActionHubTableSeeder::class,
            ConnectionTableSeeder::class,

            PaleontologyActionTableSeeder::class,
            PaleontologyCitationTableSeeder::class,
            PlantingActionTableSeeder::class,

            HerbariumTableSeeder::class,
            ProductTableSeeder::class,
            SeedTableSeeder::class,
            BioMolecularTableSeeder::class,
            SeedExchangeTableSeeder::class,
            SeedTechnologyTableSeeder::class,
            SeedWeightTableSeeder::class,
            SeedHubSeeder::class,
            seedMolecularTableSeeder::class,
            SoilHasSoilFeatureTableSeeder::class,
            evaluationCollectionTableSeeder::class,
            CryoBankTableSeeder::class,
            HerbariumAppendixTableSeeder::class,
            MediaTableSeeder::class,
            MedicinalPlantTableSeeder::class,

//            AttendanceTableSeeder::class,
            BorrowTableSeeder::class,

            CryoBankActionTableSeeder::class,
            EntryHubTableSeeder::class,
            ExchangeTableSeeder::class,
            GardenTableSeeder::class,
            ChromosomeTableSeeder::class,
            GeraminTableSeeder::class,
            BotanicalTableSeeder::class,
            BotanicalGardenActionTableSeeder::class,
            BotanicalPropagationTableSeeder::class,
            BotanicalIrrigationTableSeeder::class,
            MedicalTableSeeder::class,
            MedicinalPlantConstituentTableSeeder::class,
            MedicinalPlantMorphologyTableSeeder::class,
//            PaleontologyMediaTableSeeder::class,
            PlantApplicationTableSeeder::class,

            TechnologyCollectionTableSeeder::class,
            VisitTableSeeder::class,
            RoleTableSeeder::class,
            GroupTableSeeder::class,
            TableTableSeeder::class,
            TransitionTableSeeder::class,
            PermissionTableSeeder::class,
            MorphAuthorTableSeeder::class,
            TransitionTableSeeder::class,
            ComponentTableSeeder::class,
            MedicalComponentTableSeeder::class,
            MedicinalPlantMethodTableSeeder::class,
        ]);
        Model::reguard();

    }
}
