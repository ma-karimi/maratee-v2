<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSeedTechnologyTrait;
use Tests\ApiTestTrait;

class SeedTechnologyApiTest extends TestCase
{
    use MakeSeedTechnologyTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_seed_technology()
    {
        $seedTechnology = $this->fakeSeedTechnologyData();
        $this->response = $this->json('POST', '/api/seedTechnologies', $seedTechnology);

        $this->assertApiResponse($seedTechnology);
    }

    /**
     * @test
     */
    public function test_read_seed_technology()
    {
        $seedTechnology = $this->makeSeedTechnology();
        $this->response = $this->json('GET', '/api/seedTechnologies/'.$seedTechnology->id);

        $this->assertApiResponse($seedTechnology->toArray());
    }

    /**
     * @test
     */
    public function test_update_seed_technology()
    {
        $seedTechnology = $this->makeSeedTechnology();
        $editedSeedTechnology = $this->fakeSeedTechnologyData();

        $this->response = $this->json('PUT', '/api/seedTechnologies/'.$seedTechnology->id, $editedSeedTechnology);

        $this->assertApiResponse($editedSeedTechnology);
    }

    /**
     * @test
     */
    public function test_delete_seed_technology()
    {
        $seedTechnology = $this->makeSeedTechnology();
        $this->response = $this->json('DELETE', '/api/seedTechnologies/'.$seedTechnology->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/seedTechnologies/'.$seedTechnology->id);

        $this->response->assertStatus(404);
    }
}
