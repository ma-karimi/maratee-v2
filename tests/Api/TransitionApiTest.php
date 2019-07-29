<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeTransitionTrait;
use Tests\ApiTestTrait;

class TransitionApiTest extends TestCase
{
    use MakeTransitionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_transition()
    {
        $transition = $this->fakeTransitionData();
        $this->response = $this->json('POST', '/api/transitions', $transition);

        $this->assertApiResponse($transition);
    }

    /**
     * @test
     */
    public function test_read_transition()
    {
        $transition = $this->makeTransition();
        $this->response = $this->json('GET', '/api/transitions/'.$transition->id);

        $this->assertApiResponse($transition->toArray());
    }

    /**
     * @test
     */
    public function test_update_transition()
    {
        $transition = $this->makeTransition();
        $editedTransition = $this->fakeTransitionData();

        $this->response = $this->json('PUT', '/api/transitions/'.$transition->id, $editedTransition);

        $this->assertApiResponse($editedTransition);
    }

    /**
     * @test
     */
    public function test_delete_transition()
    {
        $transition = $this->makeTransition();
        $this->response = $this->json('DELETE', '/api/transitions/'.$transition->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/transitions/'.$transition->id);

        $this->response->assertStatus(404);
    }
}
