<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePlantingGeneralTrait;
use Tests\ApiTestTrait;

class PlantingGeneralApiTest extends TestCase
{
    use MakePlantingGeneralTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_planting_general()
    {
        $plantingGeneral = $this->fakePlantingGeneralData();
        $this->response = $this->json('POST', '/api/plantingGenerals', $plantingGeneral);

        $this->assertApiResponse($plantingGeneral);
    }

    /**
     * @test
     */
    public function test_read_planting_general()
    {
        $plantingGeneral = $this->makePlantingGeneral();
        $this->response = $this->json('GET', '/api/plantingGenerals/'.$plantingGeneral->id);

        $this->assertApiResponse($plantingGeneral->toArray());
    }

    /**
     * @test
     */
    public function test_update_planting_general()
    {
        $plantingGeneral = $this->makePlantingGeneral();
        $editedPlantingGeneral = $this->fakePlantingGeneralData();

        $this->response = $this->json('PUT', '/api/plantingGenerals/'.$plantingGeneral->id, $editedPlantingGeneral);

        $this->assertApiResponse($editedPlantingGeneral);
    }

    /**
     * @test
     */
    public function test_delete_planting_general()
    {
        $plantingGeneral = $this->makePlantingGeneral();
        $this->response = $this->json('DELETE', '/api/plantingGenerals/'.$plantingGeneral->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/plantingGenerals/'.$plantingGeneral->id);

        $this->response->assertStatus(404);
    }
}
