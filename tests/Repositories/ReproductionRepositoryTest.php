<?php namespace Tests\Repositories;

use App\Models\Reproduction;
use App\Repositories\ReproductionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeReproductionTrait;
use Tests\ApiTestTrait;

class ReproductionRepositoryTest extends TestCase
{
    use MakeReproductionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ReproductionRepository
     */
    protected $reproductionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->reproductionRepo = \App::make(ReproductionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_reproduction()
    {
        $reproduction = $this->fakeReproductionData();
        $createdReproduction = $this->reproductionRepo->create($reproduction);
        $createdReproduction = $createdReproduction->toArray();
        $this->assertArrayHasKey('id', $createdReproduction);
        $this->assertNotNull($createdReproduction['id'], 'Created Reproduction must have id specified');
        $this->assertNotNull(Reproduction::find($createdReproduction['id']), 'Reproduction with given id must be in DB');
        $this->assertModelData($reproduction, $createdReproduction);
    }

    /**
     * @test read
     */
    public function test_read_reproduction()
    {
        $reproduction = $this->makeReproduction();
        $dbReproduction = $this->reproductionRepo->find($reproduction->id);
        $dbReproduction = $dbReproduction->toArray();
        $this->assertModelData($reproduction->toArray(), $dbReproduction);
    }

    /**
     * @test update
     */
    public function test_update_reproduction()
    {
        $reproduction = $this->makeReproduction();
        $fakeReproduction = $this->fakeReproductionData();
        $updatedReproduction = $this->reproductionRepo->update($fakeReproduction, $reproduction->id);
        $this->assertModelData($fakeReproduction, $updatedReproduction->toArray());
        $dbReproduction = $this->reproductionRepo->find($reproduction->id);
        $this->assertModelData($fakeReproduction, $dbReproduction->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_reproduction()
    {
        $reproduction = $this->makeReproduction();
        $resp = $this->reproductionRepo->delete($reproduction->id);
        $this->assertTrue($resp);
        $this->assertNull(Reproduction::find($reproduction->id), 'Reproduction should not exist in DB');
    }
}
