<?php namespace Tests\Repositories;

use App\Models\SoilFeature;
use App\Repositories\SoilFeatureRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSoilFeatureTrait;
use Tests\ApiTestTrait;

class SoilFeatureRepositoryTest extends TestCase
{
    use MakeSoilFeatureTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SoilFeatureRepository
     */
    protected $soilFeatureRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->soilFeatureRepo = \App::make(SoilFeatureRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_soil_feature()
    {
        $soilFeature = $this->fakeSoilFeatureData();
        $createdSoilFeature = $this->soilFeatureRepo->create($soilFeature);
        $createdSoilFeature = $createdSoilFeature->toArray();
        $this->assertArrayHasKey('id', $createdSoilFeature);
        $this->assertNotNull($createdSoilFeature['id'], 'Created SoilFeature must have id specified');
        $this->assertNotNull(SoilFeature::find($createdSoilFeature['id']), 'SoilFeature with given id must be in DB');
        $this->assertModelData($soilFeature, $createdSoilFeature);
    }

    /**
     * @test read
     */
    public function test_read_soil_feature()
    {
        $soilFeature = $this->makeSoilFeature();
        $dbSoilFeature = $this->soilFeatureRepo->find($soilFeature->id);
        $dbSoilFeature = $dbSoilFeature->toArray();
        $this->assertModelData($soilFeature->toArray(), $dbSoilFeature);
    }

    /**
     * @test update
     */
    public function test_update_soil_feature()
    {
        $soilFeature = $this->makeSoilFeature();
        $fakeSoilFeature = $this->fakeSoilFeatureData();
        $updatedSoilFeature = $this->soilFeatureRepo->update($fakeSoilFeature, $soilFeature->id);
        $this->assertModelData($fakeSoilFeature, $updatedSoilFeature->toArray());
        $dbSoilFeature = $this->soilFeatureRepo->find($soilFeature->id);
        $this->assertModelData($fakeSoilFeature, $dbSoilFeature->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_soil_feature()
    {
        $soilFeature = $this->makeSoilFeature();
        $resp = $this->soilFeatureRepo->delete($soilFeature->id);
        $this->assertTrue($resp);
        $this->assertNull(SoilFeature::find($soilFeature->id), 'SoilFeature should not exist in DB');
    }
}
