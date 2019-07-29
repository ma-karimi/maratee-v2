<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePaleontologyMediaTrait;
use Tests\ApiTestTrait;

class PaleontologyMediaApiTest extends TestCase
{
    use MakePaleontologyMediaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_paleontology_media()
    {
        $paleontologyMedia = $this->fakePaleontologyMediaData();
        $this->response = $this->json('POST', '/api/paleontologyMedia', $paleontologyMedia);

        $this->assertApiResponse($paleontologyMedia);
    }

    /**
     * @test
     */
    public function test_read_paleontology_media()
    {
        $paleontologyMedia = $this->makePaleontologyMedia();
        $this->response = $this->json('GET', '/api/paleontologyMedia/'.$paleontologyMedia->id);

        $this->assertApiResponse($paleontologyMedia->toArray());
    }

    /**
     * @test
     */
    public function test_update_paleontology_media()
    {
        $paleontologyMedia = $this->makePaleontologyMedia();
        $editedPaleontologyMedia = $this->fakePaleontologyMediaData();

        $this->response = $this->json('PUT', '/api/paleontologyMedia/'.$paleontologyMedia->id, $editedPaleontologyMedia);

        $this->assertApiResponse($editedPaleontologyMedia);
    }

    /**
     * @test
     */
    public function test_delete_paleontology_media()
    {
        $paleontologyMedia = $this->makePaleontologyMedia();
        $this->response = $this->json('DELETE', '/api/paleontologyMedia/'.$paleontologyMedia->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/paleontologyMedia/'.$paleontologyMedia->id);

        $this->response->assertStatus(404);
    }
}
