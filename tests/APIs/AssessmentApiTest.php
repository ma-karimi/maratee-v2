<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeAssessmentTrait;
use Tests\ApiTestTrait;

class AssessmentApiTest extends TestCase
{
    use MakeAssessmentTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_assessment()
    {
        $assessment = $this->fakeAssessmentData();
        $this->response = $this->json('POST', '/api/assessments', $assessment);

        $this->assertApiResponse($assessment);
    }

    /**
     * @test
     */
    public function test_read_assessment()
    {
        $assessment = $this->makeAssessment();
        $this->response = $this->json('GET', '/api/assessments/'.$assessment->id);

        $this->assertApiResponse($assessment->toArray());
    }

    /**
     * @test
     */
    public function test_update_assessment()
    {
        $assessment = $this->makeAssessment();
        $editedAssessment = $this->fakeAssessmentData();

        $this->response = $this->json('PUT', '/api/assessments/'.$assessment->id, $editedAssessment);

        $this->assertApiResponse($editedAssessment);
    }

    /**
     * @test
     */
    public function test_delete_assessment()
    {
        $assessment = $this->makeAssessment();
        $this->response = $this->json('DELETE', '/api/assessments/'.$assessment->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/assessments/'.$assessment->id);

        $this->response->assertStatus(404);
    }
}
