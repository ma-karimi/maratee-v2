<?php namespace Tests\Repositories;

use App\Models\Plantology;
use App\Repositories\PlantologyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePlantologyTrait;
use Tests\ApiTestTrait;

class PlantologyRepositoryTest extends TestCase
{
    use MakePlantologyTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PlantologyRepository
     */
    protected $plantologyRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->plantologyRepo = \App::make(PlantologyRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_plantology()
    {
        $plantology = $this->fakePlantologyData();
        $createdPlantology = $this->plantologyRepo->create($plantology);
        $createdPlantology = $createdPlantology->toArray();
        $this->assertArrayHasKey('id', $createdPlantology);
        $this->assertNotNull($createdPlantology['id'], 'Created Plantology must have id specified');
        $this->assertNotNull(Plantology::find($createdPlantology['id']), 'Plantology with given id must be in DB');
        $this->assertModelData($plantology, $createdPlantology);
    }

    /**
     * @test read
     */
    public function test_read_plantology()
    {
        $plantology = $this->makePlantology();
        $dbPlantology = $this->plantologyRepo->find($plantology->id);
        $dbPlantology = $dbPlantology->toArray();
        $this->assertModelData($plantology->toArray(), $dbPlantology);
    }

    /**
     * @test update
     */
    public function test_update_plantology()
    {
        $plantology = $this->makePlantology();
        $fakePlantology = $this->fakePlantologyData();
        $updatedPlantology = $this->plantologyRepo->update($fakePlantology, $plantology->id);
        $this->assertModelData($fakePlantology, $updatedPlantology->toArray());
        $dbPlantology = $this->plantologyRepo->find($plantology->id);
        $this->assertModelData($fakePlantology, $dbPlantology->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_plantology()
    {
        $plantology = $this->makePlantology();
        $resp = $this->plantologyRepo->delete($plantology->id);
        $this->assertTrue($resp);
        $this->assertNull(Plantology::find($plantology->id), 'Plantology should not exist in DB');
    }
}
