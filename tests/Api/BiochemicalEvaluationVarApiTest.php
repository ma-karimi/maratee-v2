<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\BiochemicalEvaluationVar;

class BiochemicalEvaluationVarApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_biochemical_evaluation_var()
    {
        $biochemicalEvaluationVar = factory(BiochemicalEvaluationVar::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/biochemical_evaluation_vars', $biochemicalEvaluationVar
        );

        $this->assertApiResponse($biochemicalEvaluationVar);
    }

    /**
     * @test
     */
    public function test_read_biochemical_evaluation_var()
    {
        $biochemicalEvaluationVar = factory(BiochemicalEvaluationVar::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/biochemical_evaluation_vars/'.$biochemicalEvaluationVar->id
        );

        $this->assertApiResponse($biochemicalEvaluationVar->toArray());
    }

    /**
     * @test
     */
    public function test_update_biochemical_evaluation_var()
    {
        $biochemicalEvaluationVar = factory(BiochemicalEvaluationVar::class)->create();
        $editedBiochemicalEvaluationVar = factory(BiochemicalEvaluationVar::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/biochemical_evaluation_vars/'.$biochemicalEvaluationVar->id,
            $editedBiochemicalEvaluationVar
        );

        $this->assertApiResponse($editedBiochemicalEvaluationVar);
    }

    /**
     * @test
     */
    public function test_delete_biochemical_evaluation_var()
    {
        $biochemicalEvaluationVar = factory(BiochemicalEvaluationVar::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/biochemical_evaluation_vars/'.$biochemicalEvaluationVar->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/biochemical_evaluation_vars/'.$biochemicalEvaluationVar->id
        );

        $this->response->assertStatus(404);
    }
}
