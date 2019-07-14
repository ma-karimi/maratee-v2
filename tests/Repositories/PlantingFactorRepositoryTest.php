<?php namespace Tests\Repositories;

use App\Models\PlantingFactor;
use App\Repositories\PlantingFactorRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePlantingFactorTrait;
use Tests\ApiTestTrait;

class PlantingFactorRepositoryTest extends TestCase
{
    use MakePlantingFactorTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PlantingFactorRepository
     */
    protected $plantingFactorRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->plantingFactorRepo = \App::make(PlantingFactorRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_planting_factor()
    {
        $plantingFactor = $this->fakePlantingFactorData();
        $createdPlantingFactor = $this->plantingFactorRepo->create($plantingFactor);
        $createdPlantingFactor = $createdPlantingFactor->toArray();
        $this->assertArrayHasKey('id', $createdPlantingFactor);
        $this->assertNotNull($createdPlantingFactor['id'], 'Created PlantingFactor must have id specified');
        $this->assertNotNull(PlantingFactor::find($createdPlantingFactor['id']), 'PlantingFactor with given id must be in DB');
        $this->assertModelData($plantingFactor, $createdPlantingFactor);
    }

    /**
     * @test read
     */
    public function test_read_planting_factor()
    {
        $plantingFactor = $this->makePlantingFactor();
        $dbPlantingFactor = $this->plantingFactorRepo->find($plantingFactor->id);
        $dbPlantingFactor = $dbPlantingFactor->toArray();
        $this->assertModelData($plantingFactor->toArray(), $dbPlantingFactor);
    }

    /**
     * @test update
     */
    public function test_update_planting_factor()
    {
        $plantingFactor = $this->makePlantingFactor();
        $fakePlantingFactor = $this->fakePlantingFactorData();
        $updatedPlantingFactor = $this->plantingFactorRepo->update($fakePlantingFactor, $plantingFactor->id);
        $this->assertModelData($fakePlantingFactor, $updatedPlantingFactor->toArray());
        $dbPlantingFactor = $this->plantingFactorRepo->find($plantingFactor->id);
        $this->assertModelData($fakePlantingFactor, $dbPlantingFactor->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_planting_factor()
    {
        $plantingFactor = $this->makePlantingFactor();
        $resp = $this->plantingFactorRepo->delete($plantingFactor->id);
        $this->assertTrue($resp);
        $this->assertNull(PlantingFactor::find($plantingFactor->id), 'PlantingFactor should not exist in DB');
    }
}
