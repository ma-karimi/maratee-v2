<?php namespace Tests\Repositories;

use App\Models\Propagation;
use App\Repositories\PropagationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePropagationTrait;
use Tests\ApiTestTrait;

class PropagationRepositoryTest extends TestCase
{
    use MakePropagationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PropagationRepository
     */
    protected $propagationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->propagationRepo = \App::make(PropagationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_propagation()
    {
        $propagation = $this->fakePropagationData();
        $createdPropagation = $this->propagationRepo->create($propagation);
        $createdPropagation = $createdPropagation->toArray();
        $this->assertArrayHasKey('id', $createdPropagation);
        $this->assertNotNull($createdPropagation['id'], 'Created Propagation must have id specified');
        $this->assertNotNull(Propagation::find($createdPropagation['id']), 'Propagation with given id must be in DB');
        $this->assertModelData($propagation, $createdPropagation);
    }

    /**
     * @test read
     */
    public function test_read_propagation()
    {
        $propagation = $this->makePropagation();
        $dbPropagation = $this->propagationRepo->find($propagation->id);
        $dbPropagation = $dbPropagation->toArray();
        $this->assertModelData($propagation->toArray(), $dbPropagation);
    }

    /**
     * @test update
     */
    public function test_update_propagation()
    {
        $propagation = $this->makePropagation();
        $fakePropagation = $this->fakePropagationData();
        $updatedPropagation = $this->propagationRepo->update($fakePropagation, $propagation->id);
        $this->assertModelData($fakePropagation, $updatedPropagation->toArray());
        $dbPropagation = $this->propagationRepo->find($propagation->id);
        $this->assertModelData($fakePropagation, $dbPropagation->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_propagation()
    {
        $propagation = $this->makePropagation();
        $resp = $this->propagationRepo->delete($propagation->id);
        $this->assertTrue($resp);
        $this->assertNull(Propagation::find($propagation->id), 'Propagation should not exist in DB');
    }
}
