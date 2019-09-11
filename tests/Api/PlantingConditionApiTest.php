<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\PlantingCondition;

class PlantingConditionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_planting_condition()
    {
        $plantingCondition = factory(PlantingCondition::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/planting_conditions', $plantingCondition
        );

        $this->assertApiResponse($plantingCondition);
    }

    /**
     * @test
     */
    public function test_read_planting_condition()
    {
        $plantingCondition = factory(PlantingCondition::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/planting_conditions/'.$plantingCondition->id
        );

        $this->assertApiResponse($plantingCondition->toArray());
    }

    /**
     * @test
     */
    public function test_update_planting_condition()
    {
        $plantingCondition = factory(PlantingCondition::class)->create();
        $editedPlantingCondition = factory(PlantingCondition::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/planting_conditions/'.$plantingCondition->id,
            $editedPlantingCondition
        );

        $this->assertApiResponse($editedPlantingCondition);
    }

    /**
     * @test
     */
    public function test_delete_planting_condition()
    {
        $plantingCondition = factory(PlantingCondition::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/planting_conditions/'.$plantingCondition->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/planting_conditions/'.$plantingCondition->id
        );

        $this->response->assertStatus(404);
    }
}
