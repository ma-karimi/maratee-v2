<?php namespace Tests\Repositories;

use App\Models\PlantingCondition;
use App\Repositories\PlantingConditionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PlantingConditionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PlantingConditionRepository
     */
    protected $plantingConditionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->plantingConditionRepo = \App::make(PlantingConditionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_planting_condition()
    {
        $plantingCondition = factory(PlantingCondition::class)->make()->toArray();

        $createdPlantingCondition = $this->plantingConditionRepo->create($plantingCondition);

        $createdPlantingCondition = $createdPlantingCondition->toArray();
        $this->assertArrayHasKey('id', $createdPlantingCondition);
        $this->assertNotNull($createdPlantingCondition['id'], 'Created PlantingCondition must have id specified');
        $this->assertNotNull(PlantingCondition::find($createdPlantingCondition['id']), 'PlantingCondition with given id must be in DB');
        $this->assertModelData($plantingCondition, $createdPlantingCondition);
    }

    /**
     * @test read
     */
    public function test_read_planting_condition()
    {
        $plantingCondition = factory(PlantingCondition::class)->create();

        $dbPlantingCondition = $this->plantingConditionRepo->find($plantingCondition->id);

        $dbPlantingCondition = $dbPlantingCondition->toArray();
        $this->assertModelData($plantingCondition->toArray(), $dbPlantingCondition);
    }

    /**
     * @test update
     */
    public function test_update_planting_condition()
    {
        $plantingCondition = factory(PlantingCondition::class)->create();
        $fakePlantingCondition = factory(PlantingCondition::class)->make()->toArray();

        $updatedPlantingCondition = $this->plantingConditionRepo->update($fakePlantingCondition, $plantingCondition->id);

        $this->assertModelData($fakePlantingCondition, $updatedPlantingCondition->toArray());
        $dbPlantingCondition = $this->plantingConditionRepo->find($plantingCondition->id);
        $this->assertModelData($fakePlantingCondition, $dbPlantingCondition->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_planting_condition()
    {
        $plantingCondition = factory(PlantingCondition::class)->create();

        $resp = $this->plantingConditionRepo->delete($plantingCondition->id);

        $this->assertTrue($resp);
        $this->assertNull(PlantingCondition::find($plantingCondition->id), 'PlantingCondition should not exist in DB');
    }
}
