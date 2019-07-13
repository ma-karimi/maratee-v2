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
        $this->call([
            AuthorTableSeeder::class,
            ProductTableSeeder::class,
            ProjectTableSeeder::class,
            ProtectionTableSeeder::class,
            ProvinceTableSeeder::class,
            RegionTableSeeder::class,
            ReproductionTableSeeder::class,
            SeedChemicalTableSeeder::class,
            SeedExchangeTableSeeder::class,
            SeedHasPlantTableSeeder::class,
            SeedHubSeeder::class,
            SeedMolecularTableSeeder::class,
            SeedHasPlantTableSeeder::class,
            SeedTableSeeder::class,
            SeedTechnologyTableSeeder::class,
            SeedWeightTableSeeder::class,
            SoilFeatureTableSeeder::class,
            SoilHasSoilFeatureTableSeeder::class,
            TechnologyCollectionTableSeeder::class,
            TreatmentTableSeeder::class,
            UserTableSeeder::class,
            VillageTableSeeder::class,
            VisitTableSeeder::class,
        ]);
        Model::reguard();

    }
}
