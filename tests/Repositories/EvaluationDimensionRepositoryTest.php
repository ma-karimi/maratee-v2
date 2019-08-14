<?php namespace Tests\Repositories;

use App\Models\EvaluationDimension;
use App\Repositories\EvaluationDimensionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeEvaluationDimensionTrait;
use Tests\ApiTestTrait;

class EvaluationDimensionRepositoryTest extends TestCase
{
    use MakeEvaluationDimensionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var EvaluationDimensionRepository
     */
    protected $evaluationDimensionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->evaluationDimensionRepo = \App::make(EvaluationDimensionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_evaluation_dimension()
    {
        $evaluationDimension = $this->fakeEvaluationDimensionData();
        $createdEvaluationDimension = $this->evaluationDimensionRepo->create($evaluationDimension);
        $createdEvaluationDimension = $createdEvaluationDimension->toArray();
        $this->assertArrayHasKey('id', $createdEvaluationDimension);
        $this->assertNotNull($createdEvaluationDimension['id'], 'Created EvaluationDimension must have id specified');
        $this->assertNotNull(EvaluationDimension::find($createdEvaluationDimension['id']), 'EvaluationDimension with given id must be in DB');
        $this->assertModelData($evaluationDimension, $createdEvaluationDimension);
    }

    /**
     * @test read
     */
    public function test_read_evaluation_dimension()
    {
        $evaluationDimension = $this->makeEvaluationDimension();
        $dbEvaluationDimension = $this->evaluationDimensionRepo->find($evaluationDimension->id);
        $dbEvaluationDimension = $dbEvaluationDimension->toArray();
        $this->assertModelData($evaluationDimension->toArray(), $dbEvaluationDimension);
    }

    /**
     * @test update
     */
    public function test_update_evaluation_dimension()
    {
        $evaluationDimension = $this->makeEvaluationDimension();
        $fakeEvaluationDimension = $this->fakeEvaluationDimensionData();
        $updatedEvaluationDimension = $this->evaluationDimensionRepo->update($fakeEvaluationDimension, $evaluationDimension->id);
        $this->assertModelData($fakeEvaluationDimension, $updatedEvaluationDimension->toArray());
        $dbEvaluationDimension = $this->evaluationDimensionRepo->find($evaluationDimension->id);
        $this->assertModelData($fakeEvaluationDimension, $dbEvaluationDimension->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_evaluation_dimension()
    {
        $evaluationDimension = $this->makeEvaluationDimension();
        $resp = $this->evaluationDimensionRepo->delete($evaluationDimension->id);
        $this->assertTrue($resp);
        $this->assertNull(EvaluationDimension::find($evaluationDimension->id), 'EvaluationDimension should not exist in DB');
    }
}
