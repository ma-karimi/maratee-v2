<?php namespace Tests\Repositories;

use App\Models\AssessmentCollection;
use App\Repositories\AssessmentCollectionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeAssessmentCollectionTrait;
use Tests\ApiTestTrait;

class AssessmentCollectionRepositoryTest extends TestCase
{
    use MakeAssessmentCollectionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var AssessmentCollectionRepository
     */
    protected $assessmentCollectionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->assessmentCollectionRepo = \App::make(AssessmentCollectionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_assessment_collection()
    {
        $assessmentCollection = $this->fakeAssessmentCollectionData();
        $createdAssessmentCollection = $this->assessmentCollectionRepo->create($assessmentCollection);
        $createdAssessmentCollection = $createdAssessmentCollection->toArray();
        $this->assertArrayHasKey('id', $createdAssessmentCollection);
        $this->assertNotNull($createdAssessmentCollection['id'], 'Created AssessmentCollection must have id specified');
        $this->assertNotNull(AssessmentCollection::find($createdAssessmentCollection['id']), 'AssessmentCollection with given id must be in DB');
        $this->assertModelData($assessmentCollection, $createdAssessmentCollection);
    }

    /**
     * @test read
     */
    public function test_read_assessment_collection()
    {
        $assessmentCollection = $this->makeAssessmentCollection();
        $dbAssessmentCollection = $this->assessmentCollectionRepo->find($assessmentCollection->id);
        $dbAssessmentCollection = $dbAssessmentCollection->toArray();
        $this->assertModelData($assessmentCollection->toArray(), $dbAssessmentCollection);
    }

    /**
     * @test update
     */
    public function test_update_assessment_collection()
    {
        $assessmentCollection = $this->makeAssessmentCollection();
        $fakeAssessmentCollection = $this->fakeAssessmentCollectionData();
        $updatedAssessmentCollection = $this->assessmentCollectionRepo->update($fakeAssessmentCollection, $assessmentCollection->id);
        $this->assertModelData($fakeAssessmentCollection, $updatedAssessmentCollection->toArray());
        $dbAssessmentCollection = $this->assessmentCollectionRepo->find($assessmentCollection->id);
        $this->assertModelData($fakeAssessmentCollection, $dbAssessmentCollection->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_assessment_collection()
    {
        $assessmentCollection = $this->makeAssessmentCollection();
        $resp = $this->assessmentCollectionRepo->delete($assessmentCollection->id);
        $this->assertTrue($resp);
        $this->assertNull(AssessmentCollection::find($assessmentCollection->id), 'AssessmentCollection should not exist in DB');
    }
}
