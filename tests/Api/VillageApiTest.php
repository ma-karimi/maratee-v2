<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeVillageTrait;
use Tests\ApiTestTrait;

class VillageApiTest extends TestCase
{
    use MakeVillageTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_village()
    {
        $village = $this->fakeVillageData();
        $this->response = $this->json('POST', '/api/villages', $village);

        $this->assertApiResponse($village);
    }

    /**
     * @test
     */
    public function test_read_village()
    {
        $village = $this->makeVillage();
        $this->response = $this->json('GET', '/api/villages/'.$village->id);

        $this->assertApiResponse($village->toArray());
    }

    /**
     * @test
     */
    public function test_update_village()
    {
        $village = $this->makeVillage();
        $editedVillage = $this->fakeVillageData();

        $this->response = $this->json('PUT', '/api/villages/'.$village->id, $editedVillage);

        $this->assertApiResponse($editedVillage);
    }

    /**
     * @test
     */
    public function test_delete_village()
    {
        $village = $this->makeVillage();
        $this->response = $this->json('DELETE', '/api/villages/'.$village->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/villages/'.$village->id);

        $this->response->assertStatus(404);
    }
}
