<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMediaTrait;
use Tests\ApiTestTrait;

class MediaApiTest extends TestCase
{
    use MakeMediaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_media()
    {
        $media = $this->fakeMediaData();
        $this->response = $this->json('POST', '/api/media', $media);

        $this->assertApiResponse($media);
    }

    /**
     * @test
     */
    public function test_read_media()
    {
        $media = $this->makeMedia();
        $this->response = $this->json('GET', '/api/media/'.$media->id);

        $this->assertApiResponse($media->toArray());
    }

    /**
     * @test
     */
    public function test_update_media()
    {
        $media = $this->makeMedia();
        $editedMedia = $this->fakeMediaData();

        $this->response = $this->json('PUT', '/api/media/'.$media->id, $editedMedia);

        $this->assertApiResponse($editedMedia);
    }

    /**
     * @test
     */
    public function test_delete_media()
    {
        $media = $this->makeMedia();
        $this->response = $this->json('DELETE', '/api/media/'.$media->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/media/'.$media->id);

        $this->response->assertStatus(404);
    }
}
