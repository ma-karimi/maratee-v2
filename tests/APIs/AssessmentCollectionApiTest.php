<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeAssessmentCollectionTrait;
use Tests\ApiTestTrait;

class AssessmentCollectionApiTest extends TestCase
{
    use MakeAssessmentCollectionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_assessment_collection()
    {
        $assessmentCollection = $this->fakeAssessmentCollectionData();
        $this->response = $this->json('POST', '/api/assessmentCollections', $assessmentCollection);

        $this->assertApiResponse($assessmentCollection);
    }

    /**
     * @test
     */
    public function test_read_assessment_collection()
    {
        $assessmentCollection = $this->makeAssessmentCollection();
        $this->response = $this->json('GET', '/api/assessmentCollections/'.$assessmentCollection->id);

        $this->assertApiResponse($assessmentCollection->toArray());
    }

    /**
     * @test
     */
    public function test_update_assessment_collection()
    {
        $assessmentCollection = $this->makeAssessmentCollection();
        $editedAssessmentCollection = $this->fakeAssessmentCollectionData();

        $this->response = $this->json('PUT', '/api/assessmentCollections/'.$assessmentCollection->id, $editedAssessmentCollection);

        $this->assertApiResponse($editedAssessmentCollection);
    }

    /**
     * @test
     */
    public function test_delete_assessment_collection()
    {
        $assessmentCollection = $this->makeAssessmentCollection();
        $this->response = $this->json('DELETE', '/api/assessmentCollections/'.$assessmentCollection->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/assessmentCollections/'.$assessmentCollection->id);

        $this->response->assertStatus(404);
    }
}
