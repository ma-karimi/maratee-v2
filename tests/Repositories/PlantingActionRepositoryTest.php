<?php namespace Tests\Repositories;

use App\Models\PlantingAction;
use App\Repositories\PlantingActionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePlantingActionTrait;
use Tests\ApiTestTrait;

class PlantingActionRepositoryTest extends TestCase
{
    use MakePlantingActionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PlantingActionRepository
     */
    protected $plantingActionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->plantingActionRepo = \App::make(PlantingActionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_planting_action()
    {
        $plantingAction = $this->fakePlantingActionData();
        $createdPlantingAction = $this->plantingActionRepo->create($plantingAction);
        $createdPlantingAction = $createdPlantingAction->toArray();
        $this->assertArrayHasKey('id', $createdPlantingAction);
        $this->assertNotNull($createdPlantingAction['id'], 'Created PlantingAction must have id specified');
        $this->assertNotNull(PlantingAction::find($createdPlantingAction['id']), 'PlantingAction with given id must be in DB');
        $this->assertModelData($plantingAction, $createdPlantingAction);
    }

    /**
     * @test read
     */
    public function test_read_planting_action()
    {
        $plantingAction = $this->makePlantingAction();
        $dbPlantingAction = $this->plantingActionRepo->find($plantingAction->id);
        $dbPlantingAction = $dbPlantingAction->toArray();
        $this->assertModelData($plantingAction->toArray(), $dbPlantingAction);
    }

    /**
     * @test update
     */
    public function test_update_planting_action()
    {
        $plantingAction = $this->makePlantingAction();
        $fakePlantingAction = $this->fakePlantingActionData();
        $updatedPlantingAction = $this->plantingActionRepo->update($fakePlantingAction, $plantingAction->id);
        $this->assertModelData($fakePlantingAction, $updatedPlantingAction->toArray());
        $dbPlantingAction = $this->plantingActionRepo->find($plantingAction->id);
        $this->assertModelData($fakePlantingAction, $dbPlantingAction->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_planting_action()
    {
        $plantingAction = $this->makePlantingAction();
        $resp = $this->plantingActionRepo->delete($plantingAction->id);
        $this->assertTrue($resp);
        $this->assertNull(PlantingAction::find($plantingAction->id), 'PlantingAction should not exist in DB');
    }
}
