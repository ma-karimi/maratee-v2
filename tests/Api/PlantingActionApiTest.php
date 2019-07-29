<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePlantingActionTrait;
use Tests\ApiTestTrait;

class PlantingActionApiTest extends TestCase
{
    use MakePlantingActionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_planting_action()
    {
        $plantingAction = $this->fakePlantingActionData();
        $this->response = $this->json('POST', '/api/plantingActions', $plantingAction);

        $this->assertApiResponse($plantingAction);
    }

    /**
     * @test
     */
    public function test_read_planting_action()
    {
        $plantingAction = $this->makePlantingAction();
        $this->response = $this->json('GET', '/api/plantingActions/'.$plantingAction->id);

        $this->assertApiResponse($plantingAction->toArray());
    }

    /**
     * @test
     */
    public function test_update_planting_action()
    {
        $plantingAction = $this->makePlantingAction();
        $editedPlantingAction = $this->fakePlantingActionData();

        $this->response = $this->json('PUT', '/api/plantingActions/'.$plantingAction->id, $editedPlantingAction);

        $this->assertApiResponse($editedPlantingAction);
    }

    /**
     * @test
     */
    public function test_delete_planting_action()
    {
        $plantingAction = $this->makePlantingAction();
        $this->response = $this->json('DELETE', '/api/plantingActions/'.$plantingAction->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/plantingActions/'.$plantingAction->id);

        $this->response->assertStatus(404);
    }
}
