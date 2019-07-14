<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePaleontologyTrait;
use Tests\ApiTestTrait;

class PaleontologyApiTest extends TestCase
{
    use MakePaleontologyTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_paleontology()
    {
        $paleontology = $this->fakePaleontologyData();
        $this->response = $this->json('POST', '/api/paleontologies', $paleontology);

        $this->assertApiResponse($paleontology);
    }

    /**
     * @test
     */
    public function test_read_paleontology()
    {
        $paleontology = $this->makePaleontology();
        $this->response = $this->json('GET', '/api/paleontologies/'.$paleontology->id);

        $this->assertApiResponse($paleontology->toArray());
    }

    /**
     * @test
     */
    public function test_update_paleontology()
    {
        $paleontology = $this->makePaleontology();
        $editedPaleontology = $this->fakePaleontologyData();

        $this->response = $this->json('PUT', '/api/paleontologies/'.$paleontology->id, $editedPaleontology);

        $this->assertApiResponse($editedPaleontology);
    }

    /**
     * @test
     */
    public function test_delete_paleontology()
    {
        $paleontology = $this->makePaleontology();
        $this->response = $this->json('DELETE', '/api/paleontologies/'.$paleontology->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/paleontologies/'.$paleontology->id);

        $this->response->assertStatus(404);
    }
}
