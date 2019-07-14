<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeGardenTrait;
use Tests\ApiTestTrait;

class GardenApiTest extends TestCase
{
    use MakeGardenTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_garden()
    {
        $garden = $this->fakeGardenData();
        $this->response = $this->json('POST', '/api/gardens', $garden);

        $this->assertApiResponse($garden);
    }

    /**
     * @test
     */
    public function test_read_garden()
    {
        $garden = $this->makeGarden();
        $this->response = $this->json('GET', '/api/gardens/'.$garden->id);

        $this->assertApiResponse($garden->toArray());
    }

    /**
     * @test
     */
    public function test_update_garden()
    {
        $garden = $this->makeGarden();
        $editedGarden = $this->fakeGardenData();

        $this->response = $this->json('PUT', '/api/gardens/'.$garden->id, $editedGarden);

        $this->assertApiResponse($editedGarden);
    }

    /**
     * @test
     */
    public function test_delete_garden()
    {
        $garden = $this->makeGarden();
        $this->response = $this->json('DELETE', '/api/gardens/'.$garden->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/gardens/'.$garden->id);

        $this->response->assertStatus(404);
    }
}
