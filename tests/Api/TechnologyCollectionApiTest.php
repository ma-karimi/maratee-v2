<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeTechnologyCollectionTrait;
use Tests\ApiTestTrait;

class TechnologyCollectionApiTest extends TestCase
{
    use MakeTechnologyCollectionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_technology_collection()
    {
        $technologyCollection = $this->fakeTechnologyCollectionData();
        $this->response = $this->json('POST', '/api/technologyCollections', $technologyCollection);

        $this->assertApiResponse($technologyCollection);
    }

    /**
     * @test
     */
    public function test_read_technology_collection()
    {
        $technologyCollection = $this->makeTechnologyCollection();
        $this->response = $this->json('GET', '/api/technologyCollections/'.$technologyCollection->id);

        $this->assertApiResponse($technologyCollection->toArray());
    }

    /**
     * @test
     */
    public function test_update_technology_collection()
    {
        $technologyCollection = $this->makeTechnologyCollection();
        $editedTechnologyCollection = $this->fakeTechnologyCollectionData();

        $this->response = $this->json('PUT', '/api/technologyCollections/'.$technologyCollection->id, $editedTechnologyCollection);

        $this->assertApiResponse($editedTechnologyCollection);
    }

    /**
     * @test
     */
    public function test_delete_technology_collection()
    {
        $technologyCollection = $this->makeTechnologyCollection();
        $this->response = $this->json('DELETE', '/api/technologyCollections/'.$technologyCollection->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/technologyCollections/'.$technologyCollection->id);

        $this->response->assertStatus(404);
    }
}
