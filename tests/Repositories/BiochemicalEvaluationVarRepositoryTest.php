<?php namespace Tests\Repositories;

use App\Models\BiochemicalEvaluationVar;
use App\Repositories\BiochemicalEvaluationVarRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class BiochemicalEvaluationVarRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var BiochemicalEvaluationVarRepository
     */
    protected $biochemicalEvaluationVarRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->biochemicalEvaluationVarRepo = \App::make(BiochemicalEvaluationVarRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_biochemical_evaluation_var()
    {
        $biochemicalEvaluationVar = factory(BiochemicalEvaluationVar::class)->make()->toArray();

        $createdBiochemicalEvaluationVar = $this->biochemicalEvaluationVarRepo->create($biochemicalEvaluationVar);

        $createdBiochemicalEvaluationVar = $createdBiochemicalEvaluationVar->toArray();
        $this->assertArrayHasKey('id', $createdBiochemicalEvaluationVar);
        $this->assertNotNull($createdBiochemicalEvaluationVar['id'], 'Created BiochemicalEvaluationVar must have id specified');
        $this->assertNotNull(BiochemicalEvaluationVar::find($createdBiochemicalEvaluationVar['id']), 'BiochemicalEvaluationVar with given id must be in DB');
        $this->assertModelData($biochemicalEvaluationVar, $createdBiochemicalEvaluationVar);
    }

    /**
     * @test read
     */
    public function test_read_biochemical_evaluation_var()
    {
        $biochemicalEvaluationVar = factory(BiochemicalEvaluationVar::class)->create();

        $dbBiochemicalEvaluationVar = $this->biochemicalEvaluationVarRepo->find($biochemicalEvaluationVar->id);

        $dbBiochemicalEvaluationVar = $dbBiochemicalEvaluationVar->toArray();
        $this->assertModelData($biochemicalEvaluationVar->toArray(), $dbBiochemicalEvaluationVar);
    }

    /**
     * @test update
     */
    public function test_update_biochemical_evaluation_var()
    {
        $biochemicalEvaluationVar = factory(BiochemicalEvaluationVar::class)->create();
        $fakeBiochemicalEvaluationVar = factory(BiochemicalEvaluationVar::class)->make()->toArray();

        $updatedBiochemicalEvaluationVar = $this->biochemicalEvaluationVarRepo->update($fakeBiochemicalEvaluationVar, $biochemicalEvaluationVar->id);

        $this->assertModelData($fakeBiochemicalEvaluationVar, $updatedBiochemicalEvaluationVar->toArray());
        $dbBiochemicalEvaluationVar = $this->biochemicalEvaluationVarRepo->find($biochemicalEvaluationVar->id);
        $this->assertModelData($fakeBiochemicalEvaluationVar, $dbBiochemicalEvaluationVar->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_biochemical_evaluation_var()
    {
        $biochemicalEvaluationVar = factory(BiochemicalEvaluationVar::class)->create();

        $resp = $this->biochemicalEvaluationVarRepo->delete($biochemicalEvaluationVar->id);

        $this->assertTrue($resp);
        $this->assertNull(BiochemicalEvaluationVar::find($biochemicalEvaluationVar->id), 'BiochemicalEvaluationVar should not exist in DB');
    }
}
