<?php namespace Tests\Repositories;

use App\Models\Technology;
use App\Repositories\TechnologyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeTechnologyCollectionTrait;
use Tests\ApiTestTrait;

class TechnologyCollectionRepositoryTest extends TestCase
{
    use MakeTechnologyCollectionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TechnologyRepository
     */
    protected $technologyCollectionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->technologyCollectionRepo = \App::make(TechnologyRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_technology_collection()
    {
        $technologyCollection = $this->fakeTechnologyCollectionData();
        $createdTechnologyCollection = $this->technologyCollectionRepo->create($technologyCollection);
        $createdTechnologyCollection = $createdTechnologyCollection->toArray();
        $this->assertArrayHasKey('id', $createdTechnologyCollection);
        $this->assertNotNull($createdTechnologyCollection['id'], 'Created TechnologyCollection must have id specified');
        $this->assertNotNull(Technology::find($createdTechnologyCollection['id']), 'TechnologyCollection with given id must be in DB');
        $this->assertModelData($technologyCollection, $createdTechnologyCollection);
    }

    /**
     * @test read
     */
    public function test_read_technology_collection()
    {
        $technologyCollection = $this->makeTechnologyCollection();
        $dbTechnologyCollection = $this->technologyCollectionRepo->find($technologyCollection->id);
        $dbTechnologyCollection = $dbTechnologyCollection->toArray();
        $this->assertModelData($technologyCollection->toArray(), $dbTechnologyCollection);
    }

    /**
     * @test update
     */
    public function test_update_technology_collection()
    {
        $technologyCollection = $this->makeTechnologyCollection();
        $fakeTechnologyCollection = $this->fakeTechnologyCollectionData();
        $updatedTechnologyCollection = $this->technologyCollectionRepo->update($fakeTechnologyCollection, $technologyCollection->id);
        $this->assertModelData($fakeTechnologyCollection, $updatedTechnologyCollection->toArray());
        $dbTechnologyCollection = $this->technologyCollectionRepo->find($technologyCollection->id);
        $this->assertModelData($fakeTechnologyCollection, $dbTechnologyCollection->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_technology_collection()
    {
        $technologyCollection = $this->makeTechnologyCollection();
        $resp = $this->technologyCollectionRepo->delete($technologyCollection->id);
        $this->assertTrue($resp);
        $this->assertNull(Technology::find($technologyCollection->id), 'TechnologyCollection should not exist in DB');
    }
}
