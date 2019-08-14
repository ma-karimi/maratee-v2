<?php namespace Tests\Repositories;

use App\Models\seedFeature;
use App\Repositories\seedFeatureRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeseedFeatureTrait;
use Tests\ApiTestTrait;

class seedFeatureRepositoryTest extends TestCase
{
    use MakeseedFeatureTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var seedFeatureRepository
     */
    protected $seedFeatureRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->seedFeatureRepo = \App::make(seedFeatureRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_seedFeature()
    {
        $seedFeature = $this->fakeseedFeatureData();
        $createdseedFeature = $this->seedFeatureRepo->create($seedFeature);
        $createdseedFeature = $createdseedFeature->toArray();
        $this->assertArrayHasKey('id', $createdseedFeature);
        $this->assertNotNull($createdseedFeature['id'], 'Created seedFeature must have id specified');
        $this->assertNotNull(seedFeature::find($createdseedFeature['id']), 'seedFeature with given id must be in DB');
        $this->assertModelData($seedFeature, $createdseedFeature);
    }

    /**
     * @test read
     */
    public function test_read_seedFeature()
    {
        $seedFeature = $this->makeseedFeature();
        $dbseedFeature = $this->seedFeatureRepo->find($seedFeature->id);
        $dbseedFeature = $dbseedFeature->toArray();
        $this->assertModelData($seedFeature->toArray(), $dbseedFeature);
    }

    /**
     * @test update
     */
    public function test_update_seedFeature()
    {
        $seedFeature = $this->makeseedFeature();
        $fakeseedFeature = $this->fakeseedFeatureData();
        $updatedseedFeature = $this->seedFeatureRepo->update($fakeseedFeature, $seedFeature->id);
        $this->assertModelData($fakeseedFeature, $updatedseedFeature->toArray());
        $dbseedFeature = $this->seedFeatureRepo->find($seedFeature->id);
        $this->assertModelData($fakeseedFeature, $dbseedFeature->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_seedFeature()
    {
        $seedFeature = $this->makeseedFeature();
        $resp = $this->seedFeatureRepo->delete($seedFeature->id);
        $this->assertTrue($resp);
        $this->assertNull(seedFeature::find($seedFeature->id), 'seedFeature should not exist in DB');
    }
}
