<?php namespace Tests\Repositories;

use App\Models\SoilHasSoilFeature;
use App\Repositories\SoilHasSoilFeatureRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSoilHasSoilFeatureTrait;
use Tests\ApiTestTrait;

class SoilHasSoilFeatureRepositoryTest extends TestCase
{
    use MakeSoilHasSoilFeatureTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SoilHasSoilFeatureRepository
     */
    protected $soilHasSoilFeatureRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->soilHasSoilFeatureRepo = \App::make(SoilHasSoilFeatureRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_soil_has_soil_feature()
    {
        $soilHasSoilFeature = $this->fakeSoilHasSoilFeatureData();
        $createdSoilHasSoilFeature = $this->soilHasSoilFeatureRepo->create($soilHasSoilFeature);
        $createdSoilHasSoilFeature = $createdSoilHasSoilFeature->toArray();
        $this->assertArrayHasKey('id', $createdSoilHasSoilFeature);
        $this->assertNotNull($createdSoilHasSoilFeature['id'], 'Created SoilHasSoilFeature must have id specified');
        $this->assertNotNull(SoilHasSoilFeature::find($createdSoilHasSoilFeature['id']), 'SoilHasSoilFeature with given id must be in DB');
        $this->assertModelData($soilHasSoilFeature, $createdSoilHasSoilFeature);
    }

    /**
     * @test read
     */
    public function test_read_soil_has_soil_feature()
    {
        $soilHasSoilFeature = $this->makeSoilHasSoilFeature();
        $dbSoilHasSoilFeature = $this->soilHasSoilFeatureRepo->find($soilHasSoilFeature->id);
        $dbSoilHasSoilFeature = $dbSoilHasSoilFeature->toArray();
        $this->assertModelData($soilHasSoilFeature->toArray(), $dbSoilHasSoilFeature);
    }

    /**
     * @test update
     */
    public function test_update_soil_has_soil_feature()
    {
        $soilHasSoilFeature = $this->makeSoilHasSoilFeature();
        $fakeSoilHasSoilFeature = $this->fakeSoilHasSoilFeatureData();
        $updatedSoilHasSoilFeature = $this->soilHasSoilFeatureRepo->update($fakeSoilHasSoilFeature, $soilHasSoilFeature->id);
        $this->assertModelData($fakeSoilHasSoilFeature, $updatedSoilHasSoilFeature->toArray());
        $dbSoilHasSoilFeature = $this->soilHasSoilFeatureRepo->find($soilHasSoilFeature->id);
        $this->assertModelData($fakeSoilHasSoilFeature, $dbSoilHasSoilFeature->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_soil_has_soil_feature()
    {
        $soilHasSoilFeature = $this->makeSoilHasSoilFeature();
        $resp = $this->soilHasSoilFeatureRepo->delete($soilHasSoilFeature->id);
        $this->assertTrue($resp);
        $this->assertNull(SoilHasSoilFeature::find($soilHasSoilFeature->id), 'SoilHasSoilFeature should not exist in DB');
    }
}
