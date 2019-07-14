<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeActionTrait;
use Tests\ApiTestTrait;

class ActionApiTest extends TestCase
{
    use MakeActionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_action()
    {
        $action = $this->fakeActionData();
        $this->response = $this->json('POST', '/api/actions', $action);

        $this->assertApiResponse($action);
    }

    /**
     * @test
     */
    public function test_read_action()
    {
        $action = $this->makeAction();
        $this->response = $this->json('GET', '/api/actions/'.$action->id);

        $this->assertApiResponse($action->toArray());
    }

    /**
     * @test
     */
    public function test_update_action()
    {
        $action = $this->makeAction();
        $editedAction = $this->fakeActionData();

        $this->response = $this->json('PUT', '/api/actions/'.$action->id, $editedAction);

        $this->assertApiResponse($editedAction);
    }

    /**
     * @test
     */
    public function test_delete_action()
    {
        $action = $this->makeAction();
        $this->response = $this->json('DELETE', '/api/actions/'.$action->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/actions/'.$action->id);

        $this->response->assertStatus(404);
    }
}
