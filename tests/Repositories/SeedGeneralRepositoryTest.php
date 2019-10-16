<?php namespace Tests\Repositories;

use App\Models\SeedGeneral;
use App\Repositories\SeedGeneralRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SeedGeneralRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SeedGeneralRepository
     */
    protected $seedGeneralRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->seedGeneralRepo = \App::make(SeedGeneralRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_seed_general()
    {
        $seedGeneral = factory(SeedGeneral::class)->make()->toArray();

        $createdSeedGeneral = $this->seedGeneralRepo->create($seedGeneral);

        $createdSeedGeneral = $createdSeedGeneral->toArray();
        $this->assertArrayHasKey('id', $createdSeedGeneral);
        $this->assertNotNull($createdSeedGeneral['id'], 'Created SeedGeneral must have id specified');
        $this->assertNotNull(SeedGeneral::find($createdSeedGeneral['id']), 'SeedGeneral with given id must be in DB');
        $this->assertModelData($seedGeneral, $createdSeedGeneral);
    }

    /**
     * @test read
     */
    public function test_read_seed_general()
    {
        $seedGeneral = factory(SeedGeneral::class)->create();

        $dbSeedGeneral = $this->seedGeneralRepo->find($seedGeneral->id);

        $dbSeedGeneral = $dbSeedGeneral->toArray();
        $this->assertModelData($seedGeneral->toArray(), $dbSeedGeneral);
    }

    /**
     * @test update
     */
    public function test_update_seed_general()
    {
        $seedGeneral = factory(SeedGeneral::class)->create();
        $fakeSeedGeneral = factory(SeedGeneral::class)->make()->toArray();

        $updatedSeedGeneral = $this->seedGeneralRepo->update($fakeSeedGeneral, $seedGeneral->id);

        $this->assertModelData($fakeSeedGeneral, $updatedSeedGeneral->toArray());
        $dbSeedGeneral = $this->seedGeneralRepo->find($seedGeneral->id);
        $this->assertModelData($fakeSeedGeneral, $dbSeedGeneral->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_seed_general()
    {
        $seedGeneral = factory(SeedGeneral::class)->create();

        $resp = $this->seedGeneralRepo->delete($seedGeneral->id);

        $this->assertTrue($resp);
        $this->assertNull(SeedGeneral::find($seedGeneral->id), 'SeedGeneral should not exist in DB');
    }
}
