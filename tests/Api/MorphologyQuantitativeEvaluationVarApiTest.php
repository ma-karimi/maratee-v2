<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\MorphologyVariable;

class MorphologyQuantitativeEvaluationVarApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_morphology_quantitative_evaluation_var()
    {
        $morphologyQuantitativeEvaluationVar = factory(MorphologyVariable::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/morphology_quantitative_evaluation_vars', $morphologyQuantitativeEvaluationVar
        );

        $this->assertApiResponse($morphologyQuantitativeEvaluationVar);
    }

    /**
     * @test
     */
    public function test_read_morphology_quantitative_evaluation_var()
    {
        $morphologyQuantitativeEvaluationVar = factory(MorphologyVariable::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/morphology_quantitative_evaluation_vars/'.$morphologyQuantitativeEvaluationVar->id
        );

        $this->assertApiResponse($morphologyQuantitativeEvaluationVar->toArray());
    }

    /**
     * @test
     */
    public function test_update_morphology_quantitative_evaluation_var()
    {
        $morphologyQuantitativeEvaluationVar = factory(MorphologyVariable::class)->create();
        $editedMorphologyQuantitativeEvaluationVar = factory(MorphologyVariable::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/morphology_quantitative_evaluation_vars/'.$morphologyQuantitativeEvaluationVar->id,
            $editedMorphologyQuantitativeEvaluationVar
        );

        $this->assertApiResponse($editedMorphologyQuantitativeEvaluationVar);
    }

    /**
     * @test
     */
    public function test_delete_morphology_quantitative_evaluation_var()
    {
        $morphologyQuantitativeEvaluationVar = factory(MorphologyVariable::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/morphology_quantitative_evaluation_vars/'.$morphologyQuantitativeEvaluationVar->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/morphology_quantitative_evaluation_vars/'.$morphologyQuantitativeEvaluationVar->id
        );

        $this->response->assertStatus(404);
    }
}
