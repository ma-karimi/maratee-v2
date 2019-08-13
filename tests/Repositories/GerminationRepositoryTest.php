<?php namespace Tests\Repositories;

use App\Models\Germination;
use App\Repositories\GerminationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeGerminationTrait;
use Tests\ApiTestTrait;

class GerminationRepositoryTest extends TestCase
{
    use MakeGerminationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var GerminationRepository
     */
    protected $germinationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->germinationRepo = \App::make(GerminationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_germination()
    {
        $germination = $this->fakeGerminationData();
        $createdGermination = $this->germinationRepo->create($germination);
        $createdGermination = $createdGermination->toArray();
        $this->assertArrayHasKey('id', $createdGermination);
        $this->assertNotNull($createdGermination['id'], 'Created Germination must have id specified');
        $this->assertNotNull(Germination::find($createdGermination['id']), 'Germination with given id must be in DB');
        $this->assertModelData($germination, $createdGermination);
    }

    /**
     * @test read
     */
    public function test_read_germination()
    {
        $germination = $this->makeGermination();
        $dbGermination = $this->germinationRepo->find($germination->id);
        $dbGermination = $dbGermination->toArray();
        $this->assertModelData($germination->toArray(), $dbGermination);
    }

    /**
     * @test update
     */
    public function test_update_germination()
    {
        $germination = $this->makeGermination();
        $fakeGermination = $this->fakeGerminationData();
        $updatedGermination = $this->germinationRepo->update($fakeGermination, $germination->id);
        $this->assertModelData($fakeGermination, $updatedGermination->toArray());
        $dbGermination = $this->germinationRepo->find($germination->id);
        $this->assertModelData($fakeGermination, $dbGermination->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_germination()
    {
        $germination = $this->makeGermination();
        $resp = $this->germinationRepo->delete($germination->id);
        $this->assertTrue($resp);
        $this->assertNull(Germination::find($germination->id), 'Germination should not exist in DB');
    }
}
