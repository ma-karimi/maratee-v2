<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMapTrait;
use Tests\ApiTestTrait;

class MapApiTest extends TestCase
{
    use MakeMapTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_map()
    {
        $map = $this->fakeMapData();
        $this->response = $this->json('POST', '/api/maps', $map);

        $this->assertApiResponse($map);
    }

    /**
     * @test
     */
    public function test_read_map()
    {
        $map = $this->makeMap();
        $this->response = $this->json('GET', '/api/maps/'.$map->id);

        $this->assertApiResponse($map->toArray());
    }

    /**
     * @test
     */
    public function test_update_map()
    {
        $map = $this->makeMap();
        $editedMap = $this->fakeMapData();

        $this->response = $this->json('PUT', '/api/maps/'.$map->id, $editedMap);

        $this->assertApiResponse($editedMap);
    }

    /**
     * @test
     */
    public function test_delete_map()
    {
        $map = $this->makeMap();
        $this->response = $this->json('DELETE', '/api/maps/'.$map->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/maps/'.$map->id);

        $this->response->assertStatus(404);
    }
}
