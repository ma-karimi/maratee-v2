<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeHerbariumTrait;
use Tests\ApiTestTrait;

class HerbariumApiTest extends TestCase
{
    use MakeHerbariumTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_herbarium()
    {
        $herbarium = $this->fakeHerbariumData();
        $this->response = $this->json('POST', '/api/herbaria', $herbarium);

        $this->assertApiResponse($herbarium);
    }

    /**
     * @test
     */
    public function test_read_herbarium()
    {
        $herbarium = $this->makeHerbarium();
        $this->response = $this->json('GET', '/api/herbaria/'.$herbarium->id);

        $this->assertApiResponse($herbarium->toArray());
    }

    /**
     * @test
     */
    public function test_update_herbarium()
    {
        $herbarium = $this->makeHerbarium();
        $editedHerbarium = $this->fakeHerbariumData();

        $this->response = $this->json('PUT', '/api/herbaria/'.$herbarium->id, $editedHerbarium);

        $this->assertApiResponse($editedHerbarium);
    }

    /**
     * @test
     */
    public function test_delete_herbarium()
    {
        $herbarium = $this->makeHerbarium();
        $this->response = $this->json('DELETE', '/api/herbaria/'.$herbarium->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/herbaria/'.$herbarium->id);

        $this->response->assertStatus(404);
    }
}
