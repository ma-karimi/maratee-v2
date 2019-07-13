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
            UserTableSeeder::class,
            CountryTableSeeder::class,
            ProvinceTableSeeder::class,
            CityTableSeeder::class,
            AddressTableSeeder::class,
            ActionTableSeeder::class,
            AssessmentTableSeeder::class,
            AuthorTableSeeder::class,
            ArticleTableSeeder::class,
            ChemicalTableSeeder::class,
            ChromosomeTableSeeder::class,
            CollectionTableSeeder::class,
            ConstituentTableSeeder::class,
            ContinentTableSeeder::class,
            CredentialTableSeeder::class,
            CryoBankTableSeeder::class,
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
            ProtectionTableSeeder::class,
            RegionTableSeeder::class,
            ReproductionTableSeeder::class,
            SoilFeatureTableSeeder::class,
            SoilTableSeeder::class,
            VillageTableSeeder::class,
        ]);
        $this->call([
            ActionHubTableSeeder::class,
            AssessmentCollectionTableSeeder::class,
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
            GeraminTableSeeder::class,
            HerbariumTableSeeder::class,
            HerbariumAppendixTableSeeder::class,
            LocationTableSeeder::class,
            LocalityTableSeeder::class,
            MediaTableSeeder::class,
            MedicalTableSeeder::class,
            MedicinalPlantConstituentTableSeeder::class,
            MedicinalPlantMorphologyTableSeeder::class,
            MedicinalPlantTableSeeder::class,
            PaleontologyActionTableSeeder::class,
            PaleontologyCitationTableSeeder::class,
            PaleontologyMediaTableSeeder::class,
            PaleontologyTableSeeder::class,
            PlantApplicationTableSeeder::class,
            PlantingActionTableSeeder::class,
            PlantTableSeeder::class,
            ProductTableSeeder::class,
            SeedChemicalTableSeeder::class,
            SeedExchangeTableSeeder::class,
            SeedHubSeeder::class,
            SeedMolecularTableSeeder::class,
            SeedHasPlantTableSeeder::class,
            SeedTableSeeder::class,
            SeedTechnologyTableSeeder::class,
            SeedWeightTableSeeder::class,
            SoilHasSoilFeatureTableSeeder::class,
            TechnologyCollectionTableSeeder::class,
            TreatmentTableSeeder::class,
            VisitTableSeeder::class
        ]);
        Model::reguard();

    }
}
