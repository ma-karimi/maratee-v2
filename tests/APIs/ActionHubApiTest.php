<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeActionHubTrait;
use Tests\ApiTestTrait;

class ActionHubApiTest extends TestCase
{
    use MakeActionHubTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_action_hub()
    {
        $actionHub = $this->fakeActionHubData();
        $this->response = $this->json('POST', '/api/actionHubs', $actionHub);

        $this->assertApiResponse($actionHub);
    }

    /**
     * @test
     */
    public function test_read_action_hub()
    {
        $actionHub = $this->makeActionHub();
        $this->response = $this->json('GET', '/api/actionHubs/'.$actionHub->id);

        $this->assertApiResponse($actionHub->toArray());
    }

    /**
     * @test
     */
    public function test_update_action_hub()
    {
        $actionHub = $this->makeActionHub();
        $editedActionHub = $this->fakeActionHubData();

        $this->response = $this->json('PUT', '/api/actionHubs/'.$actionHub->id, $editedActionHub);

        $this->assertApiResponse($editedActionHub);
    }

    /**
     * @test
     */
    public function test_delete_action_hub()
    {
        $actionHub = $this->makeActionHub();
        $this->response = $this->json('DELETE', '/api/actionHubs/'.$actionHub->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/actionHubs/'.$actionHub->id);

        $this->response->assertStatus(404);
    }
}
