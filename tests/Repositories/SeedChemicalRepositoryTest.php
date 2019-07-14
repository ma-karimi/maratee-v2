<?php namespace Tests\Repositories;

use App\Models\SeedChemical;
use App\Repositories\SeedChemicalRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSeedChemicalTrait;
use Tests\ApiTestTrait;

class SeedChemicalRepositoryTest extends TestCase
{
    use MakeSeedChemicalTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SeedChemicalRepository
     */
    protected $seedChemicalRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->seedChemicalRepo = \App::make(SeedChemicalRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_seed_chemical()
    {
        $seedChemical = $this->fakeSeedChemicalData();
        $createdSeedChemical = $this->seedChemicalRepo->create($seedChemical);
        $createdSeedChemical = $createdSeedChemical->toArray();
        $this->assertArrayHasKey('id', $createdSeedChemical);
        $this->assertNotNull($createdSeedChemical['id'], 'Created SeedChemical must have id specified');
        $this->assertNotNull(SeedChemical::find($createdSeedChemical['id']), 'SeedChemical with given id must be in DB');
        $this->assertModelData($seedChemical, $createdSeedChemical);
    }

    /**
     * @test read
     */
    public function test_read_seed_chemical()
    {
        $seedChemical = $this->makeSeedChemical();
        $dbSeedChemical = $this->seedChemicalRepo->find($seedChemical->id);
        $dbSeedChemical = $dbSeedChemical->toArray();
        $this->assertModelData($seedChemical->toArray(), $dbSeedChemical);
    }

    /**
     * @test update
     */
    public function test_update_seed_chemical()
    {
        $seedChemical = $this->makeSeedChemical();
        $fakeSeedChemical = $this->fakeSeedChemicalData();
        $updatedSeedChemical = $this->seedChemicalRepo->update($fakeSeedChemical, $seedChemical->id);
        $this->assertModelData($fakeSeedChemical, $updatedSeedChemical->toArray());
        $dbSeedChemical = $this->seedChemicalRepo->find($seedChemical->id);
        $this->assertModelData($fakeSeedChemical, $dbSeedChemical->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_seed_chemical()
    {
        $seedChemical = $this->makeSeedChemical();
        $resp = $this->seedChemicalRepo->delete($seedChemical->id);
        $this->assertTrue($resp);
        $this->assertNull(SeedChemical::find($seedChemical->id), 'SeedChemical should not exist in DB');
    }
}
