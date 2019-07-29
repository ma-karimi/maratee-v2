<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeGeraminTrait;
use Tests\ApiTestTrait;

class GeraminApiTest extends TestCase
{
    use MakeGeraminTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_geramin()
    {
        $geramin = $this->fakeGeraminData();
        $this->response = $this->json('POST', '/api/geramins', $geramin);

        $this->assertApiResponse($geramin);
    }

    /**
     * @test
     */
    public function test_read_geramin()
    {
        $geramin = $this->makeGeramin();
        $this->response = $this->json('GET', '/api/geramins/'.$geramin->id);

        $this->assertApiResponse($geramin->toArray());
    }

    /**
     * @test
     */
    public function test_update_geramin()
    {
        $geramin = $this->makeGeramin();
        $editedGeramin = $this->fakeGeraminData();

        $this->response = $this->json('PUT', '/api/geramins/'.$geramin->id, $editedGeramin);

        $this->assertApiResponse($editedGeramin);
    }

    /**
     * @test
     */
    public function test_delete_geramin()
    {
        $geramin = $this->makeGeramin();
        $this->response = $this->json('DELETE', '/api/geramins/'.$geramin->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/geramins/'.$geramin->id);

        $this->response->assertStatus(404);
    }
}
