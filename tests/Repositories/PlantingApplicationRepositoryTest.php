<?php namespace Tests\Repositories;

use App\Models\PlantingApplication;
use App\Repositories\PlantingApplicationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePlantingApplicationTrait;
use Tests\ApiTestTrait;

class PlantingApplicationRepositoryTest extends TestCase
{
    use MakePlantingApplicationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PlantingApplicationRepository
     */
    protected $plantingApplicationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->plantingApplicationRepo = \App::make(PlantingApplicationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_planting_application()
    {
        $plantingApplication = $this->fakePlantingApplicationData();
        $createdPlantingApplication = $this->plantingApplicationRepo->create($plantingApplication);
        $createdPlantingApplication = $createdPlantingApplication->toArray();
        $this->assertArrayHasKey('id', $createdPlantingApplication);
        $this->assertNotNull($createdPlantingApplication['id'], 'Created PlantingApplication must have id specified');
        $this->assertNotNull(PlantingApplication::find($createdPlantingApplication['id']), 'PlantingApplication with given id must be in DB');
        $this->assertModelData($plantingApplication, $createdPlantingApplication);
    }

    /**
     * @test read
     */
    public function test_read_planting_application()
    {
        $plantingApplication = $this->makePlantingApplication();
        $dbPlantingApplication = $this->plantingApplicationRepo->find($plantingApplication->id);
        $dbPlantingApplication = $dbPlantingApplication->toArray();
        $this->assertModelData($plantingApplication->toArray(), $dbPlantingApplication);
    }

    /**
     * @test update
     */
    public function test_update_planting_application()
    {
        $plantingApplication = $this->makePlantingApplication();
        $fakePlantingApplication = $this->fakePlantingApplicationData();
        $updatedPlantingApplication = $this->plantingApplicationRepo->update($fakePlantingApplication, $plantingApplication->id);
        $this->assertModelData($fakePlantingApplication, $updatedPlantingApplication->toArray());
        $dbPlantingApplication = $this->plantingApplicationRepo->find($plantingApplication->id);
        $this->assertModelData($fakePlantingApplication, $dbPlantingApplication->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_planting_application()
    {
        $plantingApplication = $this->makePlantingApplication();
        $resp = $this->plantingApplicationRepo->delete($plantingApplication->id);
        $this->assertTrue($resp);
        $this->assertNull(PlantingApplication::find($plantingApplication->id), 'PlantingApplication should not exist in DB');
    }
}
