<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePlantTrait;
use Tests\ApiTestTrait;

class PlantApiTest extends TestCase
{
    use MakePlantTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_plant()
    {
        $plant = $this->fakePlantData();
        $this->response = $this->json('POST', '/api/plants', $plant);

        $this->assertApiResponse($plant);
    }

    /**
     * @test
     */
    public function test_read_plant()
    {
        $plant = $this->makePlant();
        $this->response = $this->json('GET', '/api/plants/'.$plant->id);

        $this->assertApiResponse($plant->toArray());
    }

    /**
     * @test
     */
    public function test_update_plant()
    {
        $plant = $this->makePlant();
        $editedPlant = $this->fakePlantData();

        $this->response = $this->json('PUT', '/api/plants/'.$plant->id, $editedPlant);

        $this->assertApiResponse($editedPlant);
    }

    /**
     * @test
     */
    public function test_delete_plant()
    {
        $plant = $this->makePlant();
        $this->response = $this->json('DELETE', '/api/plants/'.$plant->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/plants/'.$plant->id);

        $this->response->assertStatus(404);
    }
}
