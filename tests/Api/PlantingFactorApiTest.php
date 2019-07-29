<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePlantingFactorTrait;
use Tests\ApiTestTrait;

class PlantingFactorApiTest extends TestCase
{
    use MakePlantingFactorTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_planting_factor()
    {
        $plantingFactor = $this->fakePlantingFactorData();
        $this->response = $this->json('POST', '/api/plantingFactors', $plantingFactor);

        $this->assertApiResponse($plantingFactor);
    }

    /**
     * @test
     */
    public function test_read_planting_factor()
    {
        $plantingFactor = $this->makePlantingFactor();
        $this->response = $this->json('GET', '/api/plantingFactors/'.$plantingFactor->id);

        $this->assertApiResponse($plantingFactor->toArray());
    }

    /**
     * @test
     */
    public function test_update_planting_factor()
    {
        $plantingFactor = $this->makePlantingFactor();
        $editedPlantingFactor = $this->fakePlantingFactorData();

        $this->response = $this->json('PUT', '/api/plantingFactors/'.$plantingFactor->id, $editedPlantingFactor);

        $this->assertApiResponse($editedPlantingFactor);
    }

    /**
     * @test
     */
    public function test_delete_planting_factor()
    {
        $plantingFactor = $this->makePlantingFactor();
        $this->response = $this->json('DELETE', '/api/plantingFactors/'.$plantingFactor->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/plantingFactors/'.$plantingFactor->id);

        $this->response->assertStatus(404);
    }
}
