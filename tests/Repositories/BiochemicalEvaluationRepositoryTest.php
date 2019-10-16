<?php namespace Tests\Repositories;

use App\Models\BiochemicalEvaluation;
use App\Repositories\BiochemicalEvaluationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class BiochemicalEvaluationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var BiochemicalEvaluationRepository
     */
    protected $biochemicalEvaluationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->biochemicalEvaluationRepo = \App::make(BiochemicalEvaluationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_biochemical_evaluation()
    {
        $biochemicalEvaluation = factory(BiochemicalEvaluation::class)->make()->toArray();

        $createdBiochemicalEvaluation = $this->biochemicalEvaluationRepo->create($biochemicalEvaluation);

        $createdBiochemicalEvaluation = $createdBiochemicalEvaluation->toArray();
        $this->assertArrayHasKey('id', $createdBiochemicalEvaluation);
        $this->assertNotNull($createdBiochemicalEvaluation['id'], 'Created BiochemicalEvaluation must have id specified');
        $this->assertNotNull(BiochemicalEvaluation::find($createdBiochemicalEvaluation['id']), 'BiochemicalEvaluation with given id must be in DB');
        $this->assertModelData($biochemicalEvaluation, $createdBiochemicalEvaluation);
    }

    /**
     * @test read
     */
    public function test_read_biochemical_evaluation()
    {
        $biochemicalEvaluation = factory(BiochemicalEvaluation::class)->create();

        $dbBiochemicalEvaluation = $this->biochemicalEvaluationRepo->find($biochemicalEvaluation->id);

        $dbBiochemicalEvaluation = $dbBiochemicalEvaluation->toArray();
        $this->assertModelData($biochemicalEvaluation->toArray(), $dbBiochemicalEvaluation);
    }

    /**
     * @test update
     */
    public function test_update_biochemical_evaluation()
    {
        $biochemicalEvaluation = factory(BiochemicalEvaluation::class)->create();
        $fakeBiochemicalEvaluation = factory(BiochemicalEvaluation::class)->make()->toArray();

        $updatedBiochemicalEvaluation = $this->biochemicalEvaluationRepo->update($fakeBiochemicalEvaluation, $biochemicalEvaluation->id);

        $this->assertModelData($fakeBiochemicalEvaluation, $updatedBiochemicalEvaluation->toArray());
        $dbBiochemicalEvaluation = $this->biochemicalEvaluationRepo->find($biochemicalEvaluation->id);
        $this->assertModelData($fakeBiochemicalEvaluation, $dbBiochemicalEvaluation->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_biochemical_evaluation()
    {
        $biochemicalEvaluation = factory(BiochemicalEvaluation::class)->create();

        $resp = $this->biochemicalEvaluationRepo->delete($biochemicalEvaluation->id);

        $this->assertTrue($resp);
        $this->assertNull(BiochemicalEvaluation::find($biochemicalEvaluation->id), 'BiochemicalEvaluation should not exist in DB');
    }
}
