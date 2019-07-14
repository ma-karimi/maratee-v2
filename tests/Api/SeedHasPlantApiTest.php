<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSeedHasPlantTrait;
use Tests\ApiTestTrait;

class SeedHasPlantApiTest extends TestCase
{
    use MakeSeedHasPlantTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_seed_has_plant()
    {
        $seedHasPlant = $this->fakeSeedHasPlantData();
        $this->response = $this->json('POST', '/api/seedHasPlants', $seedHasPlant);

        $this->assertApiResponse($seedHasPlant);
    }

    /**
     * @test
     */
    public function test_read_seed_has_plant()
    {
        $seedHasPlant = $this->makeSeedHasPlant();
        $this->response = $this->json('GET', '/api/seedHasPlants/'.$seedHasPlant->id);

        $this->assertApiResponse($seedHasPlant->toArray());
    }

    /**
     * @test
     */
    public function test_update_seed_has_plant()
    {
        $seedHasPlant = $this->makeSeedHasPlant();
        $editedSeedHasPlant = $this->fakeSeedHasPlantData();

        $this->response = $this->json('PUT', '/api/seedHasPlants/'.$seedHasPlant->id, $editedSeedHasPlant);

        $this->assertApiResponse($editedSeedHasPlant);
    }

    /**
     * @test
     */
    public function test_delete_seed_has_plant()
    {
        $seedHasPlant = $this->makeSeedHasPlant();
        $this->response = $this->json('DELETE', '/api/seedHasPlants/'.$seedHasPlant->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/seedHasPlants/'.$seedHasPlant->id);

        $this->response->assertStatus(404);
    }
}
