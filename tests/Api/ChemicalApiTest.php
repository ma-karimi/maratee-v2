<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeChemicalTrait;
use Tests\ApiTestTrait;

class ChemicalApiTest extends TestCase
{
    use MakeChemicalTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_chemical()
    {
        $chemical = $this->fakeChemicalData();
        $this->response = $this->json('POST', '/api/chemicals', $chemical);

        $this->assertApiResponse($chemical);
    }

    /**
     * @test
     */
    public function test_read_chemical()
    {
        $chemical = $this->makeChemical();
        $this->response = $this->json('GET', '/api/chemicals/'.$chemical->id);

        $this->assertApiResponse($chemical->toArray());
    }

    /**
     * @test
     */
    public function test_update_chemical()
    {
        $chemical = $this->makeChemical();
        $editedChemical = $this->fakeChemicalData();

        $this->response = $this->json('PUT', '/api/chemicals/'.$chemical->id, $editedChemical);

        $this->assertApiResponse($editedChemical);
    }

    /**
     * @test
     */
    public function test_delete_chemical()
    {
        $chemical = $this->makeChemical();
        $this->response = $this->json('DELETE', '/api/chemicals/'.$chemical->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/chemicals/'.$chemical->id);

        $this->response->assertStatus(404);
    }
}
