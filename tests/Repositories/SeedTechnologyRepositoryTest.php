<?php namespace Tests\Repositories;

use App\Models\SeedEvaluation;
use App\Repositories\SeedTechnologyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSeedTechnologyTrait;
use Tests\ApiTestTrait;

class SeedTechnologyRepositoryTest extends TestCase
{
    use MakeSeedTechnologyTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SeedTechnologyRepository
     */
    protected $seedTechnologyRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->seedTechnologyRepo = \App::make(SeedTechnologyRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_seed_technology()
    {
        $seedTechnology = $this->fakeSeedTechnologyData();
        $createdSeedTechnology = $this->seedTechnologyRepo->create($seedTechnology);
        $createdSeedTechnology = $createdSeedTechnology->toArray();
        $this->assertArrayHasKey('id', $createdSeedTechnology);
        $this->assertNotNull($createdSeedTechnology['id'], 'Created SeedTechnology must have id specified');
        $this->assertNotNull(SeedEvaluation::find($createdSeedTechnology['id']), 'SeedTechnology with given id must be in DB');
        $this->assertModelData($seedTechnology, $createdSeedTechnology);
    }

    /**
     * @test read
     */
    public function test_read_seed_technology()
    {
        $seedTechnology = $this->makeSeedTechnology();
        $dbSeedTechnology = $this->seedTechnologyRepo->find($seedTechnology->id);
        $dbSeedTechnology = $dbSeedTechnology->toArray();
        $this->assertModelData($seedTechnology->toArray(), $dbSeedTechnology);
    }

    /**
     * @test update
     */
    public function test_update_seed_technology()
    {
        $seedTechnology = $this->makeSeedTechnology();
        $fakeSeedTechnology = $this->fakeSeedTechnologyData();
        $updatedSeedTechnology = $this->seedTechnologyRepo->update($fakeSeedTechnology, $seedTechnology->id);
        $this->assertModelData($fakeSeedTechnology, $updatedSeedTechnology->toArray());
        $dbSeedTechnology = $this->seedTechnologyRepo->find($seedTechnology->id);
        $this->assertModelData($fakeSeedTechnology, $dbSeedTechnology->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_seed_technology()
    {
        $seedTechnology = $this->makeSeedTechnology();
        $resp = $this->seedTechnologyRepo->delete($seedTechnology->id);
        $this->assertTrue($resp);
        $this->assertNull(SeedEvaluation::find($seedTechnology->id), 'SeedTechnology should not exist in DB');
    }
}
