<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePaleontologyActionTrait;
use Tests\ApiTestTrait;

class PaleontologyActionApiTest extends TestCase
{
    use MakePaleontologyActionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_paleontology_action()
    {
        $paleontologyAction = $this->fakePaleontologyActionData();
        $this->response = $this->json('POST', '/api/paleontologyActions', $paleontologyAction);

        $this->assertApiResponse($paleontologyAction);
    }

    /**
     * @test
     */
    public function test_read_paleontology_action()
    {
        $paleontologyAction = $this->makePaleontologyAction();
        $this->response = $this->json('GET', '/api/paleontologyActions/'.$paleontologyAction->id);

        $this->assertApiResponse($paleontologyAction->toArray());
    }

    /**
     * @test
     */
    public function test_update_paleontology_action()
    {
        $paleontologyAction = $this->makePaleontologyAction();
        $editedPaleontologyAction = $this->fakePaleontologyActionData();

        $this->response = $this->json('PUT', '/api/paleontologyActions/'.$paleontologyAction->id, $editedPaleontologyAction);

        $this->assertApiResponse($editedPaleontologyAction);
    }

    /**
     * @test
     */
    public function test_delete_paleontology_action()
    {
        $paleontologyAction = $this->makePaleontologyAction();
        $this->response = $this->json('DELETE', '/api/paleontologyActions/'.$paleontologyAction->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/paleontologyActions/'.$paleontologyAction->id);

        $this->response->assertStatus(404);
    }
}
