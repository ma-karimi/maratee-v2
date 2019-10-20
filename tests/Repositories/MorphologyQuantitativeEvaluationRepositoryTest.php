<?php namespace Tests\Repositories;

use App\Models\MorphologyQuantitativeEvaluation;
use App\Repositories\MorphologyQuantitativeEvaluationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MorphologyQuantitativeEvaluationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MorphologyQuantitativeEvaluationRepository
     */
    protected $morphologyQuantitativeEvaluationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->morphologyQuantitativeEvaluationRepo = \App::make(MorphologyQuantitativeEvaluationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_morphology_quantitative_evaluation()
    {
        $morphologyQuantitativeEvaluation = factory(MorphologyQuantitativeEvaluation::class)->make()->toArray();

        $createdMorphologyQuantitativeEvaluation = $this->morphologyQuantitativeEvaluationRepo->create($morphologyQuantitativeEvaluation);

        $createdMorphologyQuantitativeEvaluation = $createdMorphologyQuantitativeEvaluation->toArray();
        $this->assertArrayHasKey('id', $createdMorphologyQuantitativeEvaluation);
        $this->assertNotNull($createdMorphologyQuantitativeEvaluation['id'], 'Created MorphologyQuantitativeEvaluation must have id specified');
        $this->assertNotNull(MorphologyQuantitativeEvaluation::find($createdMorphologyQuantitativeEvaluation['id']), 'MorphologyQuantitativeEvaluation with given id must be in DB');
        $this->assertModelData($morphologyQuantitativeEvaluation, $createdMorphologyQuantitativeEvaluation);
    }

    /**
     * @test read
     */
    public function test_read_morphology_quantitative_evaluation()
    {
        $morphologyQuantitativeEvaluation = factory(MorphologyQuantitativeEvaluation::class)->create();

        $dbMorphologyQuantitativeEvaluation = $this->morphologyQuantitativeEvaluationRepo->find($morphologyQuantitativeEvaluation->id);

        $dbMorphologyQuantitativeEvaluation = $dbMorphologyQuantitativeEvaluation->toArray();
        $this->assertModelData($morphologyQuantitativeEvaluation->toArray(), $dbMorphologyQuantitativeEvaluation);
    }

    /**
     * @test update
     */
    public function test_update_morphology_quantitative_evaluation()
    {
        $morphologyQuantitativeEvaluation = factory(MorphologyQuantitativeEvaluation::class)->create();
        $fakeMorphologyQuantitativeEvaluation = factory(MorphologyQuantitativeEvaluation::class)->make()->toArray();

        $updatedMorphologyQuantitativeEvaluation = $this->morphologyQuantitativeEvaluationRepo->update($fakeMorphologyQuantitativeEvaluation, $morphologyQuantitativeEvaluation->id);

        $this->assertModelData($fakeMorphologyQuantitativeEvaluation, $updatedMorphologyQuantitativeEvaluation->toArray());
        $dbMorphologyQuantitativeEvaluation = $this->morphologyQuantitativeEvaluationRepo->find($morphologyQuantitativeEvaluation->id);
        $this->assertModelData($fakeMorphologyQuantitativeEvaluation, $dbMorphologyQuantitativeEvaluation->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_morphology_quantitative_evaluation()
    {
        $morphologyQuantitativeEvaluation = factory(MorphologyQuantitativeEvaluation::class)->create();

        $resp = $this->morphologyQuantitativeEvaluationRepo->delete($morphologyQuantitativeEvaluation->id);

        $this->assertTrue($resp);
        $this->assertNull(MorphologyQuantitativeEvaluation::find($morphologyQuantitativeEvaluation->id), 'MorphologyQuantitativeEvaluation should not exist in DB');
    }
}
