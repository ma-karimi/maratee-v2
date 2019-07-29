<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeRegionTrait;
use Tests\ApiTestTrait;

class RegionApiTest extends TestCase
{
    use MakeRegionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_region()
    {
        $region = $this->fakeRegionData();
        $this->response = $this->json('POST', '/api/regions', $region);

        $this->assertApiResponse($region);
    }

    /**
     * @test
     */
    public function test_read_region()
    {
        $region = $this->makeRegion();
        $this->response = $this->json('GET', '/api/regions/'.$region->id);

        $this->assertApiResponse($region->toArray());
    }

    /**
     * @test
     */
    public function test_update_region()
    {
        $region = $this->makeRegion();
        $editedRegion = $this->fakeRegionData();

        $this->response = $this->json('PUT', '/api/regions/'.$region->id, $editedRegion);

        $this->assertApiResponse($editedRegion);
    }

    /**
     * @test
     */
    public function test_delete_region()
    {
        $region = $this->makeRegion();
        $this->response = $this->json('DELETE', '/api/regions/'.$region->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/regions/'.$region->id);

        $this->response->assertStatus(404);
    }
}
