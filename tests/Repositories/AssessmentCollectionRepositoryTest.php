<?php namespace Tests\Repositories;

use App\Models\evaluationCollection;
use App\Repositories\evaluationCollectionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeevaluationCollectionTrait;
use Tests\ApiTestTrait;

class evaluationCollectionRepositoryTest extends TestCase
{
    use MakeevaluationCollectionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var evaluationCollectionRepository
     */
    protected $evaluationCollectionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->evaluationCollectionRepo = \App::make(evaluationCollectionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_evaluation_collection()
    {
        $evaluationCollection = $this->fakeevaluationCollectionData();
        $createdevaluationCollection = $this->evaluationCollectionRepo->create($evaluationCollection);
        $createdevaluationCollection = $createdevaluationCollection->toArray();
        $this->assertArrayHasKey('id', $createdevaluationCollection);
        $this->assertNotNull($createdevaluationCollection['id'], 'Created evaluationCollection must have id specified');
        $this->assertNotNull(evaluationCollection::find($createdevaluationCollection['id']), 'evaluationCollection with given id must be in DB');
        $this->assertModelData($evaluationCollection, $createdevaluationCollection);
    }

    /**
     * @test read
     */
    public function test_read_evaluation_collection()
    {
        $evaluationCollection = $this->makeevaluationCollection();
        $dbevaluationCollection = $this->evaluationCollectionRepo->find($evaluationCollection->id);
        $dbevaluationCollection = $dbevaluationCollection->toArray();
        $this->assertModelData($evaluationCollection->toArray(), $dbevaluationCollection);
    }

    /**
     * @test update
     */
    public function test_update_evaluation_collection()
    {
        $evaluationCollection = $this->makeevaluationCollection();
        $fakeevaluationCollection = $this->fakeevaluationCollectionData();
        $updatedevaluationCollection = $this->evaluationCollectionRepo->update($fakeevaluationCollection, $evaluationCollection->id);
        $this->assertModelData($fakeevaluationCollection, $updatedevaluationCollection->toArray());
        $dbevaluationCollection = $this->evaluationCollectionRepo->find($evaluationCollection->id);
        $this->assertModelData($fakeevaluationCollection, $dbevaluationCollection->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_evaluation_collection()
    {
        $evaluationCollection = $this->makeevaluationCollection();
        $resp = $this->evaluationCollectionRepo->delete($evaluationCollection->id);
        $this->assertTrue($resp);
        $this->assertNull(evaluationCollection::find($evaluationCollection->id), 'evaluationCollection should not exist in DB');
    }
}
