<?php namespace Tests\Repositories;

use App\Models\MorphologyQuantitativeEvaluationVar;
use App\Repositories\MorphologyQuantitativeEvaluationVarRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MorphologyQuantitativeEvaluationVarRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MorphologyQuantitativeEvaluationVarRepository
     */
    protected $morphologyQuantitativeEvaluationVarRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->morphologyQuantitativeEvaluationVarRepo = \App::make(MorphologyQuantitativeEvaluationVarRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_morphology_quantitative_evaluation_var()
    {
        $morphologyQuantitativeEvaluationVar = factory(MorphologyQuantitativeEvaluationVar::class)->make()->toArray();

        $createdMorphologyQuantitativeEvaluationVar = $this->morphologyQuantitativeEvaluationVarRepo->create($morphologyQuantitativeEvaluationVar);

        $createdMorphologyQuantitativeEvaluationVar = $createdMorphologyQuantitativeEvaluationVar->toArray();
        $this->assertArrayHasKey('id', $createdMorphologyQuantitativeEvaluationVar);
        $this->assertNotNull($createdMorphologyQuantitativeEvaluationVar['id'], 'Created MorphologyQuantitativeEvaluationVar must have id specified');
        $this->assertNotNull(MorphologyQuantitativeEvaluationVar::find($createdMorphologyQuantitativeEvaluationVar['id']), 'MorphologyQuantitativeEvaluationVar with given id must be in DB');
        $this->assertModelData($morphologyQuantitativeEvaluationVar, $createdMorphologyQuantitativeEvaluationVar);
    }

    /**
     * @test read
     */
    public function test_read_morphology_quantitative_evaluation_var()
    {
        $morphologyQuantitativeEvaluationVar = factory(MorphologyQuantitativeEvaluationVar::class)->create();

        $dbMorphologyQuantitativeEvaluationVar = $this->morphologyQuantitativeEvaluationVarRepo->find($morphologyQuantitativeEvaluationVar->id);

        $dbMorphologyQuantitativeEvaluationVar = $dbMorphologyQuantitativeEvaluationVar->toArray();
        $this->assertModelData($morphologyQuantitativeEvaluationVar->toArray(), $dbMorphologyQuantitativeEvaluationVar);
    }

    /**
     * @test update
     */
    public function test_update_morphology_quantitative_evaluation_var()
    {
        $morphologyQuantitativeEvaluationVar = factory(MorphologyQuantitativeEvaluationVar::class)->create();
        $fakeMorphologyQuantitativeEvaluationVar = factory(MorphologyQuantitativeEvaluationVar::class)->make()->toArray();

        $updatedMorphologyQuantitativeEvaluationVar = $this->morphologyQuantitativeEvaluationVarRepo->update($fakeMorphologyQuantitativeEvaluationVar, $morphologyQuantitativeEvaluationVar->id);

        $this->assertModelData($fakeMorphologyQuantitativeEvaluationVar, $updatedMorphologyQuantitativeEvaluationVar->toArray());
        $dbMorphologyQuantitativeEvaluationVar = $this->morphologyQuantitativeEvaluationVarRepo->find($morphologyQuantitativeEvaluationVar->id);
        $this->assertModelData($fakeMorphologyQuantitativeEvaluationVar, $dbMorphologyQuantitativeEvaluationVar->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_morphology_quantitative_evaluation_var()
    {
        $morphologyQuantitativeEvaluationVar = factory(MorphologyQuantitativeEvaluationVar::class)->create();

        $resp = $this->morphologyQuantitativeEvaluationVarRepo->delete($morphologyQuantitativeEvaluationVar->id);

        $this->assertTrue($resp);
        $this->assertNull(MorphologyQuantitativeEvaluationVar::find($morphologyQuantitativeEvaluationVar->id), 'MorphologyQuantitativeEvaluationVar should not exist in DB');
    }
}
