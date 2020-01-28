<?php namespace Tests\Repositories;

use App\Models\MorphologyQualitativeEvaluation;
use App\Repositories\SeedMorphologyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MorphologyQualitativeEvaluationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SeedMorphologyRepository
     */
    protected $morphologyQualitativeEvaluationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->morphologyQualitativeEvaluationRepo = \App::make(SeedMorphologyRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_morphology_qualitative_evaluation()
    {
        $morphologyQualitativeEvaluation = factory(MorphologyQualitativeEvaluation::class)->make()->toArray();

        $createdMorphologyQualitativeEvaluation = $this->morphologyQualitativeEvaluationRepo->create($morphologyQualitativeEvaluation);

        $createdMorphologyQualitativeEvaluation = $createdMorphologyQualitativeEvaluation->toArray();
        $this->assertArrayHasKey('id', $createdMorphologyQualitativeEvaluation);
        $this->assertNotNull($createdMorphologyQualitativeEvaluation['id'], 'Created MorphologyQualitativeEvaluation must have id specified');
        $this->assertNotNull(MorphologyQualitativeEvaluation::find($createdMorphologyQualitativeEvaluation['id']), 'MorphologyQualitativeEvaluation with given id must be in DB');
        $this->assertModelData($morphologyQualitativeEvaluation, $createdMorphologyQualitativeEvaluation);
    }

    /**
     * @test read
     */
    public function test_read_morphology_qualitative_evaluation()
    {
        $morphologyQualitativeEvaluation = factory(MorphologyQualitativeEvaluation::class)->create();

        $dbMorphologyQualitativeEvaluation = $this->morphologyQualitativeEvaluationRepo->find($morphologyQualitativeEvaluation->id);

        $dbMorphologyQualitativeEvaluation = $dbMorphologyQualitativeEvaluation->toArray();
        $this->assertModelData($morphologyQualitativeEvaluation->toArray(), $dbMorphologyQualitativeEvaluation);
    }

    /**
     * @test update
     */
    public function test_update_morphology_qualitative_evaluation()
    {
        $morphologyQualitativeEvaluation = factory(MorphologyQualitativeEvaluation::class)->create();
        $fakeMorphologyQualitativeEvaluation = factory(MorphologyQualitativeEvaluation::class)->make()->toArray();

        $updatedMorphologyQualitativeEvaluation = $this->morphologyQualitativeEvaluationRepo->update($fakeMorphologyQualitativeEvaluation, $morphologyQualitativeEvaluation->id);

        $this->assertModelData($fakeMorphologyQualitativeEvaluation, $updatedMorphologyQualitativeEvaluation->toArray());
        $dbMorphologyQualitativeEvaluation = $this->morphologyQualitativeEvaluationRepo->find($morphologyQualitativeEvaluation->id);
        $this->assertModelData($fakeMorphologyQualitativeEvaluation, $dbMorphologyQualitativeEvaluation->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_morphology_qualitative_evaluation()
    {
        $morphologyQualitativeEvaluation = factory(MorphologyQualitativeEvaluation::class)->create();

        $resp = $this->morphologyQualitativeEvaluationRepo->delete($morphologyQualitativeEvaluation->id);

        $this->assertTrue($resp);
        $this->assertNull(MorphologyQualitativeEvaluation::find($morphologyQualitativeEvaluation->id), 'MorphologyQualitativeEvaluation should not exist in DB');
    }
}
