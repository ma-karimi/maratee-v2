<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeIrrigationTrait;
use Tests\ApiTestTrait;

class IrrigationApiTest extends TestCase
{
    use MakeIrrigationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_irrigation()
    {
        $irrigation = $this->fakeIrrigationData();
        $this->response = $this->json('POST', '/api/irrigations', $irrigation);

        $this->assertApiResponse($irrigation);
    }

    /**
     * @test
     */
    public function test_read_irrigation()
    {
        $irrigation = $this->makeIrrigation();
        $this->response = $this->json('GET', '/api/irrigations/'.$irrigation->id);

        $this->assertApiResponse($irrigation->toArray());
    }

    /**
     * @test
     */
    public function test_update_irrigation()
    {
        $irrigation = $this->makeIrrigation();
        $editedIrrigation = $this->fakeIrrigationData();

        $this->response = $this->json('PUT', '/api/irrigations/'.$irrigation->id, $editedIrrigation);

        $this->assertApiResponse($editedIrrigation);
    }

    /**
     * @test
     */
    public function test_delete_irrigation()
    {
        $irrigation = $this->makeIrrigation();
        $this->response = $this->json('DELETE', '/api/irrigations/'.$irrigation->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/irrigations/'.$irrigation->id);

        $this->response->assertStatus(404);
    }
}
