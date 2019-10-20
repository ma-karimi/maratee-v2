<?php namespace Tests\Repositories;

use App\Models\MolecularEvaluationVar;
use App\Repositories\MolecularEvaluationVarRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MolecularEvaluationVarRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MolecularEvaluationVarRepository
     */
    protected $molecularEvaluationVarRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->molecularEvaluationVarRepo = \App::make(MolecularEvaluationVarRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_molecular_evaluation_var()
    {
        $molecularEvaluationVar = factory(MolecularEvaluationVar::class)->make()->toArray();

        $createdMolecularEvaluationVar = $this->molecularEvaluationVarRepo->create($molecularEvaluationVar);

        $createdMolecularEvaluationVar = $createdMolecularEvaluationVar->toArray();
        $this->assertArrayHasKey('id', $createdMolecularEvaluationVar);
        $this->assertNotNull($createdMolecularEvaluationVar['id'], 'Created MolecularEvaluationVar must have id specified');
        $this->assertNotNull(MolecularEvaluationVar::find($createdMolecularEvaluationVar['id']), 'MolecularEvaluationVar with given id must be in DB');
        $this->assertModelData($molecularEvaluationVar, $createdMolecularEvaluationVar);
    }

    /**
     * @test read
     */
    public function test_read_molecular_evaluation_var()
    {
        $molecularEvaluationVar = factory(MolecularEvaluationVar::class)->create();

        $dbMolecularEvaluationVar = $this->molecularEvaluationVarRepo->find($molecularEvaluationVar->id);

        $dbMolecularEvaluationVar = $dbMolecularEvaluationVar->toArray();
        $this->assertModelData($molecularEvaluationVar->toArray(), $dbMolecularEvaluationVar);
    }

    /**
     * @test update
     */
    public function test_update_molecular_evaluation_var()
    {
        $molecularEvaluationVar = factory(MolecularEvaluationVar::class)->create();
        $fakeMolecularEvaluationVar = factory(MolecularEvaluationVar::class)->make()->toArray();

        $updatedMolecularEvaluationVar = $this->molecularEvaluationVarRepo->update($fakeMolecularEvaluationVar, $molecularEvaluationVar->id);

        $this->assertModelData($fakeMolecularEvaluationVar, $updatedMolecularEvaluationVar->toArray());
        $dbMolecularEvaluationVar = $this->molecularEvaluationVarRepo->find($molecularEvaluationVar->id);
        $this->assertModelData($fakeMolecularEvaluationVar, $dbMolecularEvaluationVar->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_molecular_evaluation_var()
    {
        $molecularEvaluationVar = factory(MolecularEvaluationVar::class)->create();

        $resp = $this->molecularEvaluationVarRepo->delete($molecularEvaluationVar->id);

        $this->assertTrue($resp);
        $this->assertNull(MolecularEvaluationVar::find($molecularEvaluationVar->id), 'MolecularEvaluationVar should not exist in DB');
    }
}
