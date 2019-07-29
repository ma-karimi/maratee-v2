<?php namespace Tests\Repositories;

use App\Models\Assessment;
use App\Repositories\AssessmentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeAssessmentTrait;
use Tests\ApiTestTrait;

class AssessmentRepositoryTest extends TestCase
{
    use MakeAssessmentTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var AssessmentRepository
     */
    protected $assessmentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->assessmentRepo = \App::make(AssessmentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_assessment()
    {
        $assessment = $this->fakeAssessmentData();
        $createdAssessment = $this->assessmentRepo->create($assessment);
        $createdAssessment = $createdAssessment->toArray();
        $this->assertArrayHasKey('id', $createdAssessment);
        $this->assertNotNull($createdAssessment['id'], 'Created Assessment must have id specified');
        $this->assertNotNull(Assessment::find($createdAssessment['id']), 'Assessment with given id must be in DB');
        $this->assertModelData($assessment, $createdAssessment);
    }

    /**
     * @test read
     */
    public function test_read_assessment()
    {
        $assessment = $this->makeAssessment();
        $dbAssessment = $this->assessmentRepo->find($assessment->id);
        $dbAssessment = $dbAssessment->toArray();
        $this->assertModelData($assessment->toArray(), $dbAssessment);
    }

    /**
     * @test update
     */
    public function test_update_assessment()
    {
        $assessment = $this->makeAssessment();
        $fakeAssessment = $this->fakeAssessmentData();
        $updatedAssessment = $this->assessmentRepo->update($fakeAssessment, $assessment->id);
        $this->assertModelData($fakeAssessment, $updatedAssessment->toArray());
        $dbAssessment = $this->assessmentRepo->find($assessment->id);
        $this->assertModelData($fakeAssessment, $dbAssessment->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_assessment()
    {
        $assessment = $this->makeAssessment();
        $resp = $this->assessmentRepo->delete($assessment->id);
        $this->assertTrue($resp);
        $this->assertNull(Assessment::find($assessment->id), 'Assessment should not exist in DB');
    }
}
