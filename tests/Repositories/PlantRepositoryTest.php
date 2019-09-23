<?php namespace Tests\Repositories;

use App\Models\PlantHerbarium;
use App\Repositories\PlantRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePlantTrait;
use Tests\ApiTestTrait;

class PlantRepositoryTest extends TestCase
{
    use MakePlantTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PlantRepository
     */
    protected $plantRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->plantRepo = \App::make(PlantRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_plant()
    {
        $plant = $this->fakePlantData();
        $createdPlant = $this->plantRepo->create($plant);
        $createdPlant = $createdPlant->toArray();
        $this->assertArrayHasKey('id', $createdPlant);
        $this->assertNotNull($createdPlant['id'], 'Created Plant must have id specified');
        $this->assertNotNull(PlantHerbarium::find($createdPlant['id']), 'Plant with given id must be in DB');
        $this->assertModelData($plant, $createdPlant);
    }

    /**
     * @test read
     */
    public function test_read_plant()
    {
        $plant = $this->makePlant();
        $dbPlant = $this->plantRepo->find($plant->id);
        $dbPlant = $dbPlant->toArray();
        $this->assertModelData($plant->toArray(), $dbPlant);
    }

    /**
     * @test update
     */
    public function test_update_plant()
    {
        $plant = $this->makePlant();
        $fakePlant = $this->fakePlantData();
        $updatedPlant = $this->plantRepo->update($fakePlant, $plant->id);
        $this->assertModelData($fakePlant, $updatedPlant->toArray());
        $dbPlant = $this->plantRepo->find($plant->id);
        $this->assertModelData($fakePlant, $dbPlant->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_plant()
    {
        $plant = $this->makePlant();
        $resp = $this->plantRepo->delete($plant->id);
        $this->assertTrue($resp);
        $this->assertNull(PlantHerbarium::find($plant->id), 'Plant should not exist in DB');
    }
}
