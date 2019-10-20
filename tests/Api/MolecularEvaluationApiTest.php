<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MolecularEvaluation;

class MolecularEvaluationApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_molecular_evaluation()
    {
        $molecularEvaluation = factory(MolecularEvaluation::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/molecular_evaluations', $molecularEvaluation
        );

        $this->assertApiResponse($molecularEvaluation);
    }

    /**
     * @test
     */
    public function test_read_molecular_evaluation()
    {
        $molecularEvaluation = factory(MolecularEvaluation::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/molecular_evaluations/'.$molecularEvaluation->id
        );

        $this->assertApiResponse($molecularEvaluation->toArray());
    }

    /**
     * @test
     */
    public function test_update_molecular_evaluation()
    {
        $molecularEvaluation = factory(MolecularEvaluation::class)->create();
        $editedMolecularEvaluation = factory(MolecularEvaluation::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/molecular_evaluations/'.$molecularEvaluation->id,
            $editedMolecularEvaluation
        );

        $this->assertApiResponse($editedMolecularEvaluation);
    }

    /**
     * @test
     */
    public function test_delete_molecular_evaluation()
    {
        $molecularEvaluation = factory(MolecularEvaluation::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/molecular_evaluations/'.$molecularEvaluation->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/molecular_evaluations/'.$molecularEvaluation->id
        );

        $this->response->assertStatus(404);
    }
}
