<?php namespace Tests\Repositories;

use App\Models\evaluation;
use App\Repositories\evaluationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeevaluationTrait;
use Tests\ApiTestTrait;

class evaluationRepositoryTest extends TestCase
{
    use MakeevaluationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var evaluationRepository
     */
    protected $evaluationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->evaluationRepo = \App::make(evaluationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_evaluation()
    {
        $evaluation = $this->fakeevaluationData();
        $createdevaluation = $this->evaluationRepo->create($evaluation);
        $createdevaluation = $createdevaluation->toArray();
        $this->assertArrayHasKey('id', $createdevaluation);
        $this->assertNotNull($createdevaluation['id'], 'Created evaluation must have id specified');
        $this->assertNotNull(evaluation::find($createdevaluation['id']), 'evaluation with given id must be in DB');
        $this->assertModelData($evaluation, $createdevaluation);
    }

    /**
     * @test read
     */
    public function test_read_evaluation()
    {
        $evaluation = $this->makeevaluation();
        $dbevaluation = $this->evaluationRepo->find($evaluation->id);
        $dbevaluation = $dbevaluation->toArray();
        $this->assertModelData($evaluation->toArray(), $dbevaluation);
    }

    /**
     * @test update
     */
    public function test_update_evaluation()
    {
        $evaluation = $this->makeevaluation();
        $fakeevaluation = $this->fakeevaluationData();
        $updatedevaluation = $this->evaluationRepo->update($fakeevaluation, $evaluation->id);
        $this->assertModelData($fakeevaluation, $updatedevaluation->toArray());
        $dbevaluation = $this->evaluationRepo->find($evaluation->id);
        $this->assertModelData($fakeevaluation, $dbevaluation->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_evaluation()
    {
        $evaluation = $this->makeevaluation();
        $resp = $this->evaluationRepo->delete($evaluation->id);
        $this->assertTrue($resp);
        $this->assertNull(evaluation::find($evaluation->id), 'evaluation should not exist in DB');
    }
}
