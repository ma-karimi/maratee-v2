<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePaleontologyCitationTrait;
use Tests\ApiTestTrait;

class PaleontologyCitationApiTest extends TestCase
{
    use MakePaleontologyCitationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_paleontology_citation()
    {
        $paleontologyCitation = $this->fakePaleontologyCitationData();
        $this->response = $this->json('POST', '/api/paleontologyCitations', $paleontologyCitation);

        $this->assertApiResponse($paleontologyCitation);
    }

    /**
     * @test
     */
    public function test_read_paleontology_citation()
    {
        $paleontologyCitation = $this->makePaleontologyCitation();
        $this->response = $this->json('GET', '/api/paleontologyCitations/'.$paleontologyCitation->id);

        $this->assertApiResponse($paleontologyCitation->toArray());
    }

    /**
     * @test
     */
    public function test_update_paleontology_citation()
    {
        $paleontologyCitation = $this->makePaleontologyCitation();
        $editedPaleontologyCitation = $this->fakePaleontologyCitationData();

        $this->response = $this->json('PUT', '/api/paleontologyCitations/'.$paleontologyCitation->id, $editedPaleontologyCitation);

        $this->assertApiResponse($editedPaleontologyCitation);
    }

    /**
     * @test
     */
    public function test_delete_paleontology_citation()
    {
        $paleontologyCitation = $this->makePaleontologyCitation();
        $this->response = $this->json('DELETE', '/api/paleontologyCitations/'.$paleontologyCitation->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/paleontologyCitations/'.$paleontologyCitation->id);

        $this->response->assertStatus(404);
    }
}
