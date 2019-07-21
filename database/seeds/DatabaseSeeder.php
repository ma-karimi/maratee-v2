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
        ini_set('max_execution_time', 3000);
        ini_set('memory_limit', '2000M');
        $this->call([
            RoleTableSeeder::class,
            GroupTableSeeder::class,
            TableTableSeeder::class,
            TransitionTableSeeder::class,
            PermissionTableSeeder::class,
            UserTableSeeder::class,
            ContinentTableSeeder::class,
            CountryTableSeeder::class,
            ProvinceTableSeeder::class,
            CityTableSeeder::class,
            VillageTableSeeder::class,
            AddressTableSeeder::class,
            ActionTableSeeder::class,
            AssessmentTableSeeder::class,
            AuthorTableSeeder::class,
            ArticleTableSeeder::class,
            ChemicalTableSeeder::class,
            CollectionTableSeeder::class,
            ConstituentTableSeeder::class,
            CredentialTableSeeder::class,
            ProtectionTableSeeder::class,
            DepartmentTableSeeder::class,
            EntryTableSeeder::class,
            GeologyAgeTableSeeder::class,
            IrrigationTableSeeder::class,
            LanguageTableSeeder::class,
            LightingTableSeeder::class,
            MapTableSeeder::class,
            MedicineTableSeeder::class,
            MolecularTableSeeder::class,
            MorphologyTableSeeder::class,
            OrganizationTableSeeder::class,
            PlantFactorTableSeeder::class,
            PlantGeneralTableSeeder::class,
            PlantologyTableSeeder::class,
            ProjectTableSeeder::class,
            RegionTableSeeder::class,
            ReproductionTableSeeder::class,
            SoilTableSeeder::class,
            SoilFeatureTableSeeder::class,
            PaleontologyTableSeeder::class,
            TreatmentTableSeeder::class,
            MethodTableSeeder::class,

        ]);
        $this->call([
            LocationTableSeeder::class,
            LocalityTableSeeder::class,
            HerbariumTableSeeder::class,
            SeedTableSeeder::class,
            AssessmentCollectionTableSeeder::class,
            ActionHubTableSeeder::class,
            CryoBankTableSeeder::class,
            HerbariumAppendixTableSeeder::class,
            MediaTableSeeder::class,
            MedicinalPlantTableSeeder::class,

            AttendanceTableSeeder::class,
            BorrowTableSeeder::class,
            BotanicalTableSeeder::class,
            BotanicalGardenActionTableSeeder::class,
            BotanicalReproductionTableSeeder::class,
            BotanicalIrrigationTableSeeder::class,
            ConnectionTableSeeder::class,
            CryoBankActionTableSeeder::class,
            EntryHubTableSeeder::class,
            ExchangeTableSeeder::class,
            GardenTableSeeder::class,
            ChromosomeTableSeeder::class,
            GeraminTableSeeder::class,

            MedicalTableSeeder::class,
            MedicinalPlantConstituentTableSeeder::class,
            MedicinalPlantMorphologyTableSeeder::class,
            PaleontologyActionTableSeeder::class,
            PaleontologyCitationTableSeeder::class,
            PaleontologyMediaTableSeeder::class,
            PlantApplicationTableSeeder::class,
            PlantingActionTableSeeder::class,
            PlantTableSeeder::class,
            ProductTableSeeder::class,
            SeedChemicalTableSeeder::class,
            SeedExchangeTableSeeder::class,
            SeedTechnologyTableSeeder::class,
            SeedWeightTableSeeder::class,
            SeedHubSeeder::class,
            SeedMolecularTableSeeder::class,
            SeedHasPlantTableSeeder::class,
            SoilHasSoilFeatureTableSeeder::class,
            TechnologyCollectionTableSeeder::class,
            VisitTableSeeder::class,

        ]);
        Model::reguard();

    }
}
