<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeContinentTrait;
use Tests\ApiTestTrait;

class ContinentApiTest extends TestCase
{
    use MakeContinentTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_continent()
    {
        $continent = $this->fakeContinentData();
        $this->response = $this->json('POST', '/api/continents', $continent);

        $this->assertApiResponse($continent);
    }

    /**
     * @test
     */
    public function test_read_continent()
    {
        $continent = $this->makeContinent();
        $this->response = $this->json('GET', '/api/continents/'.$continent->id);

        $this->assertApiResponse($continent->toArray());
    }

    /**
     * @test
     */
    public function test_update_continent()
    {
        $continent = $this->makeContinent();
        $editedContinent = $this->fakeContinentData();

        $this->response = $this->json('PUT', '/api/continents/'.$continent->id, $editedContinent);

        $this->assertApiResponse($editedContinent);
    }

    /**
     * @test
     */
    public function test_delete_continent()
    {
        $continent = $this->makeContinent();
        $this->response = $this->json('DELETE', '/api/continents/'.$continent->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/continents/'.$continent->id);

        $this->response->assertStatus(404);
    }
}
