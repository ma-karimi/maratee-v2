<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MolecularEvaluationVar;

class MolecularEvaluationVarApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_molecular_evaluation_var()
    {
        $molecularEvaluationVar = factory(MolecularEvaluationVar::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/molecular_evaluation_vars', $molecularEvaluationVar
        );

        $this->assertApiResponse($molecularEvaluationVar);
    }

    /**
     * @test
     */
    public function test_read_molecular_evaluation_var()
    {
        $molecularEvaluationVar = factory(MolecularEvaluationVar::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/molecular_evaluation_vars/'.$molecularEvaluationVar->id
        );

        $this->assertApiResponse($molecularEvaluationVar->toArray());
    }

    /**
     * @test
     */
    public function test_update_molecular_evaluation_var()
    {
        $molecularEvaluationVar = factory(MolecularEvaluationVar::class)->create();
        $editedMolecularEvaluationVar = factory(MolecularEvaluationVar::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/molecular_evaluation_vars/'.$molecularEvaluationVar->id,
            $editedMolecularEvaluationVar
        );

        $this->assertApiResponse($editedMolecularEvaluationVar);
    }

    /**
     * @test
     */
    public function test_delete_molecular_evaluation_var()
    {
        $molecularEvaluationVar = factory(MolecularEvaluationVar::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/molecular_evaluation_vars/'.$molecularEvaluationVar->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/molecular_evaluation_vars/'.$molecularEvaluationVar->id
        );

        $this->response->assertStatus(404);
    }
}
