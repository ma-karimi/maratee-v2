<?php namespace Tests\Repositories;

use App\Models\MolecularEvaluation;
use App\Repositories\MolecularEvaluationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MolecularEvaluationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MolecularEvaluationRepository
     */
    protected $molecularEvaluationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->molecularEvaluationRepo = \App::make(MolecularEvaluationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_molecular_evaluation()
    {
        $molecularEvaluation = factory(MolecularEvaluation::class)->make()->toArray();

        $createdMolecularEvaluation = $this->molecularEvaluationRepo->create($molecularEvaluation);

        $createdMolecularEvaluation = $createdMolecularEvaluation->toArray();
        $this->assertArrayHasKey('id', $createdMolecularEvaluation);
        $this->assertNotNull($createdMolecularEvaluation['id'], 'Created MolecularEvaluation must have id specified');
        $this->assertNotNull(MolecularEvaluation::find($createdMolecularEvaluation['id']), 'MolecularEvaluation with given id must be in DB');
        $this->assertModelData($molecularEvaluation, $createdMolecularEvaluation);
    }

    /**
     * @test read
     */
    public function test_read_molecular_evaluation()
    {
        $molecularEvaluation = factory(MolecularEvaluation::class)->create();

        $dbMolecularEvaluation = $this->molecularEvaluationRepo->find($molecularEvaluation->id);

        $dbMolecularEvaluation = $dbMolecularEvaluation->toArray();
        $this->assertModelData($molecularEvaluation->toArray(), $dbMolecularEvaluation);
    }

    /**
     * @test update
     */
    public function test_update_molecular_evaluation()
    {
        $molecularEvaluation = factory(MolecularEvaluation::class)->create();
        $fakeMolecularEvaluation = factory(MolecularEvaluation::class)->make()->toArray();

        $updatedMolecularEvaluation = $this->molecularEvaluationRepo->update($fakeMolecularEvaluation, $molecularEvaluation->id);

        $this->assertModelData($fakeMolecularEvaluation, $updatedMolecularEvaluation->toArray());
        $dbMolecularEvaluation = $this->molecularEvaluationRepo->find($molecularEvaluation->id);
        $this->assertModelData($fakeMolecularEvaluation, $dbMolecularEvaluation->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_molecular_evaluation()
    {
        $molecularEvaluation = factory(MolecularEvaluation::class)->create();

        $resp = $this->molecularEvaluationRepo->delete($molecularEvaluation->id);

        $this->assertTrue($resp);
        $this->assertNull(MolecularEvaluation::find($molecularEvaluation->id), 'MolecularEvaluation should not exist in DB');
    }
}
