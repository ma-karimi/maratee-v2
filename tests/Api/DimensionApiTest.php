<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeDimensionTrait;
use Tests\ApiTestTrait;

class DimensionApiTest extends TestCase
{
    use MakeDimensionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_dimension()
    {
        $dimension = $this->fakeDimensionData();
        $this->response = $this->json('POST', '/api/dimensions', $dimension);

        $this->assertApiResponse($dimension);
    }

    /**
     * @test
     */
    public function test_read_dimension()
    {
        $dimension = $this->makeDimension();
        $this->response = $this->json('GET', '/api/dimensions/'.$dimension->id);

        $this->assertApiResponse($dimension->toArray());
    }

    /**
     * @test
     */
    public function test_update_dimension()
    {
        $dimension = $this->makeDimension();
        $editedDimension = $this->fakeDimensionData();

        $this->response = $this->json('PUT', '/api/dimensions/'.$dimension->id, $editedDimension);

        $this->assertApiResponse($editedDimension);
    }

    /**
     * @test
     */
    public function test_delete_dimension()
    {
        $dimension = $this->makeDimension();
        $this->response = $this->json('DELETE', '/api/dimensions/'.$dimension->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/dimensions/'.$dimension->id);

        $this->response->assertStatus(404);
    }
}
