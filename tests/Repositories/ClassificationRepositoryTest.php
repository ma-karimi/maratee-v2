<?php namespace Tests\Repositories;

use App\Models\Classification;
use App\Repositories\ClassificationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeClassificationTrait;
use Tests\ApiTestTrait;

class ClassificationRepositoryTest extends TestCase
{
    use MakeClassificationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ClassificationRepository
     */
    protected $classificationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->classificationRepo = \App::make(ClassificationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_classification()
    {
        $classification = $this->fakeClassificationData();
        $createdClassification = $this->classificationRepo->create($classification);
        $createdClassification = $createdClassification->toArray();
        $this->assertArrayHasKey('id', $createdClassification);
        $this->assertNotNull($createdClassification['id'], 'Created Classification must have id specified');
        $this->assertNotNull(Classification::find($createdClassification['id']), 'Classification with given id must be in DB');
        $this->assertModelData($classification, $createdClassification);
    }

    /**
     * @test read
     */
    public function test_read_classification()
    {
        $classification = $this->makeClassification();
        $dbClassification = $this->classificationRepo->find($classification->id);
        $dbClassification = $dbClassification->toArray();
        $this->assertModelData($classification->toArray(), $dbClassification);
    }

    /**
     * @test update
     */
    public function test_update_classification()
    {
        $classification = $this->makeClassification();
        $fakeClassification = $this->fakeClassificationData();
        $updatedClassification = $this->classificationRepo->update($fakeClassification, $classification->id);
        $this->assertModelData($fakeClassification, $updatedClassification->toArray());
        $dbClassification = $this->classificationRepo->find($classification->id);
        $this->assertModelData($fakeClassification, $dbClassification->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_classification()
    {
        $classification = $this->makeClassification();
        $resp = $this->classificationRepo->delete($classification->id);
        $this->assertTrue($resp);
        $this->assertNull(Classification::find($classification->id), 'Classification should not exist in DB');
    }
}
