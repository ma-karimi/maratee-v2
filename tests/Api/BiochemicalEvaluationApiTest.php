<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\BiochemicalEvaluation;

class BiochemicalEvaluationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_biochemical_evaluation()
    {
        $biochemicalEvaluation = factory(BiochemicalEvaluation::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/biochemical_evaluations', $biochemicalEvaluation
        );

        $this->assertApiResponse($biochemicalEvaluation);
    }

    /**
     * @test
     */
    public function test_read_biochemical_evaluation()
    {
        $biochemicalEvaluation = factory(BiochemicalEvaluation::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/biochemical_evaluations/'.$biochemicalEvaluation->id
        );

        $this->assertApiResponse($biochemicalEvaluation->toArray());
    }

    /**
     * @test
     */
    public function test_update_biochemical_evaluation()
    {
        $biochemicalEvaluation = factory(BiochemicalEvaluation::class)->create();
        $editedBiochemicalEvaluation = factory(BiochemicalEvaluation::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/biochemical_evaluations/'.$biochemicalEvaluation->id,
            $editedBiochemicalEvaluation
        );

        $this->assertApiResponse($editedBiochemicalEvaluation);
    }

    /**
     * @test
     */
    public function test_delete_biochemical_evaluation()
    {
        $biochemicalEvaluation = factory(BiochemicalEvaluation::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/biochemical_evaluations/'.$biochemicalEvaluation->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/biochemical_evaluations/'.$biochemicalEvaluation->id
        );

        $this->response->assertStatus(404);
    }
}
