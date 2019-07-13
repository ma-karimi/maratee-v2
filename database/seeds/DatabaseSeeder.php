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
            ChromosomeTableSeeder::class,
            CollectionTableSeeder::class,
            ConstituentTableSeeder::class,
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
            PaleontologyTableSeeder::class,
            TreatmentTableSeeder::class,

        ]);
        $this->call([
            LocationTableSeeder::class,
            LocalityTableSeeder::class,
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
            MediaTableSeeder::class,
            MedicalTableSeeder::class,
            MedicinalPlantConstituentTableSeeder::class,
            MedicinalPlantMorphologyTableSeeder::class,
            MedicinalPlantTableSeeder::class,
            PaleontologyActionTableSeeder::class,
            PaleontologyCitationTableSeeder::class,
            PaleontologyMediaTableSeeder::class,
            PlantApplicationTableSeeder::class,
            PlantingActionTableSeeder::class,
            PlantTableSeeder::class,
            ProductTableSeeder::class,
            SeedTableSeeder::class,
            SeedChemicalTableSeeder::class,
            SeedExchangeTableSeeder::class,
            SeedTechnologyTableSeeder::class,
            SeedWeightTableSeeder::class,
            SeedHubSeeder::class,
            SeedMolecularTableSeeder::class,
            SeedHasPlantTableSeeder::class,/////////////////////////////////////////
            SoilHasSoilFeatureTableSeeder::class,
            TechnologyCollectionTableSeeder::class,
            VisitTableSeeder::class
        ]);
        Model::reguard();

    }
}
