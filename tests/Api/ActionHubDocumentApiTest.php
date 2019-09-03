<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ActionHubDocument;

class ActionHubDocumentApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_action_hub_document()
    {
        $actionHubDocument = factory(ActionHubDocument::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/action_hub_documents', $actionHubDocument
        );

        $this->assertApiResponse($actionHubDocument);
    }

    /**
     * @test
     */
    public function test_read_action_hub_document()
    {
        $actionHubDocument = factory(ActionHubDocument::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/action_hub_documents/'.$actionHubDocument->id
        );

        $this->assertApiResponse($actionHubDocument->toArray());
    }

    /**
     * @test
     */
    public function test_update_action_hub_document()
    {
        $actionHubDocument = factory(ActionHubDocument::class)->create();
        $editedActionHubDocument = factory(ActionHubDocument::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/action_hub_documents/'.$actionHubDocument->id,
            $editedActionHubDocument
        );

        $this->assertApiResponse($editedActionHubDocument);
    }

    /**
     * @test
     */
    public function test_delete_action_hub_document()
    {
        $actionHubDocument = factory(ActionHubDocument::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/action_hub_documents/'.$actionHubDocument->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/action_hub_documents/'.$actionHubDocument->id
        );

        $this->response->assertStatus(404);
    }
}
