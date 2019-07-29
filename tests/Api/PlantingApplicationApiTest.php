<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePlantingApplicationTrait;
use Tests\ApiTestTrait;

class PlantingApplicationApiTest extends TestCase
{
    use MakePlantingApplicationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_planting_application()
    {
        $plantingApplication = $this->fakePlantingApplicationData();
        $this->response = $this->json('POST', '/api/plantingApplications', $plantingApplication);

        $this->assertApiResponse($plantingApplication);
    }

    /**
     * @test
     */
    public function test_read_planting_application()
    {
        $plantingApplication = $this->makePlantingApplication();
        $this->response = $this->json('GET', '/api/plantingApplications/'.$plantingApplication->id);

        $this->assertApiResponse($plantingApplication->toArray());
    }

    /**
     * @test
     */
    public function test_update_planting_application()
    {
        $plantingApplication = $this->makePlantingApplication();
        $editedPlantingApplication = $this->fakePlantingApplicationData();

        $this->response = $this->json('PUT', '/api/plantingApplications/'.$plantingApplication->id, $editedPlantingApplication);

        $this->assertApiResponse($editedPlantingApplication);
    }

    /**
     * @test
     */
    public function test_delete_planting_application()
    {
        $plantingApplication = $this->makePlantingApplication();
        $this->response = $this->json('DELETE', '/api/plantingApplications/'.$plantingApplication->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/plantingApplications/'.$plantingApplication->id);

        $this->response->assertStatus(404);
    }
}
