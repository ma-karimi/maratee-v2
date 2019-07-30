<?php namespace Tests\Repositories;

use App\Models\PlantingGeneral;
use App\Repositories\GeneralRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePlantingGeneralTrait;
use Tests\ApiTestTrait;

class PlantingGeneralRepositoryTest extends TestCase
{
    use MakePlantingGeneralTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var GeneralRepository
     */
    protected $plantingGeneralRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->plantingGeneralRepo = \App::make(GeneralRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_planting_general()
    {
        $plantingGeneral = $this->fakePlantingGeneralData();
        $createdPlantingGeneral = $this->plantingGeneralRepo->create($plantingGeneral);
        $createdPlantingGeneral = $createdPlantingGeneral->toArray();
        $this->assertArrayHasKey('id', $createdPlantingGeneral);
        $this->assertNotNull($createdPlantingGeneral['id'], 'Created PlantingGeneral must have id specified');
        $this->assertNotNull(PlantingGeneral::find($createdPlantingGeneral['id']), 'PlantingGeneral with given id must be in DB');
        $this->assertModelData($plantingGeneral, $createdPlantingGeneral);
    }

    /**
     * @test read
     */
    public function test_read_planting_general()
    {
        $plantingGeneral = $this->makePlantingGeneral();
        $dbPlantingGeneral = $this->plantingGeneralRepo->find($plantingGeneral->id);
        $dbPlantingGeneral = $dbPlantingGeneral->toArray();
        $this->assertModelData($plantingGeneral->toArray(), $dbPlantingGeneral);
    }

    /**
     * @test update
     */
    public function test_update_planting_general()
    {
        $plantingGeneral = $this->makePlantingGeneral();
        $fakePlantingGeneral = $this->fakePlantingGeneralData();
        $updatedPlantingGeneral = $this->plantingGeneralRepo->update($fakePlantingGeneral, $plantingGeneral->id);
        $this->assertModelData($fakePlantingGeneral, $updatedPlantingGeneral->toArray());
        $dbPlantingGeneral = $this->plantingGeneralRepo->find($plantingGeneral->id);
        $this->assertModelData($fakePlantingGeneral, $dbPlantingGeneral->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_planting_general()
    {
        $plantingGeneral = $this->makePlantingGeneral();
        $resp = $this->plantingGeneralRepo->delete($plantingGeneral->id);
        $this->assertTrue($resp);
        $this->assertNull(PlantingGeneral::find($plantingGeneral->id), 'PlantingGeneral should not exist in DB');
    }
}
