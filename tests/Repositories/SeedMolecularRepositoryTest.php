<?php namespace Tests\Repositories;

use App\Models\SeedMolecular;
use App\Repositories\SeedMolecularRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSeedMolecularTrait;
use Tests\ApiTestTrait;

class SeedMolecularRepositoryTest extends TestCase
{
    use MakeSeedMolecularTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SeedMolecularRepository
     */
    protected $seedMolecularRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->seedMolecularRepo = \App::make(SeedMolecularRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_seed_molecular()
    {
        $seedMolecular = $this->fakeSeedMolecularData();
        $createdSeedMolecular = $this->seedMolecularRepo->create($seedMolecular);
        $createdSeedMolecular = $createdSeedMolecular->toArray();
        $this->assertArrayHasKey('id', $createdSeedMolecular);
        $this->assertNotNull($createdSeedMolecular['id'], 'Created SeedMolecular must have id specified');
        $this->assertNotNull(SeedMolecular::find($createdSeedMolecular['id']), 'SeedMolecular with given id must be in DB');
        $this->assertModelData($seedMolecular, $createdSeedMolecular);
    }

    /**
     * @test read
     */
    public function test_read_seed_molecular()
    {
        $seedMolecular = $this->makeSeedMolecular();
        $dbSeedMolecular = $this->seedMolecularRepo->find($seedMolecular->id);
        $dbSeedMolecular = $dbSeedMolecular->toArray();
        $this->assertModelData($seedMolecular->toArray(), $dbSeedMolecular);
    }

    /**
     * @test update
     */
    public function test_update_seed_molecular()
    {
        $seedMolecular = $this->makeSeedMolecular();
        $fakeSeedMolecular = $this->fakeSeedMolecularData();
        $updatedSeedMolecular = $this->seedMolecularRepo->update($fakeSeedMolecular, $seedMolecular->id);
        $this->assertModelData($fakeSeedMolecular, $updatedSeedMolecular->toArray());
        $dbSeedMolecular = $this->seedMolecularRepo->find($seedMolecular->id);
        $this->assertModelData($fakeSeedMolecular, $dbSeedMolecular->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_seed_molecular()
    {
        $seedMolecular = $this->makeSeedMolecular();
        $resp = $this->seedMolecularRepo->delete($seedMolecular->id);
        $this->assertTrue($resp);
        $this->assertNull(SeedMolecular::find($seedMolecular->id), 'SeedMolecular should not exist in DB');
    }
}
