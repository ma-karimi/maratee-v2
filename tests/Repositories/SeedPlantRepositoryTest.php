<?php namespace Tests\Repositories;

use App\Models\SeedPlant;
use App\Repositories\SeedPlantRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSeedPlantTrait;
use Tests\ApiTestTrait;

class SeedPlantRepositoryTest extends TestCase
{
    use MakeSeedPlantTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SeedPlantRepository
     */
    protected $seedPlantRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->seedPlantRepo = \App::make(SeedPlantRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_seed_plant()
    {
        $seedPlant = $this->fakeSeedPlantData();
        $createdSeedPlant = $this->seedPlantRepo->create($seedPlant);
        $createdSeedPlant = $createdSeedPlant->toArray();
        $this->assertArrayHasKey('id', $createdSeedPlant);
        $this->assertNotNull($createdSeedPlant['id'], 'Created SeedPlant must have id specified');
        $this->assertNotNull(SeedPlant::find($createdSeedPlant['id']), 'SeedPlant with given id must be in DB');
        $this->assertModelData($seedPlant, $createdSeedPlant);
    }

    /**
     * @test read
     */
    public function test_read_seed_plant()
    {
        $seedPlant = $this->makeSeedPlant();
        $dbSeedPlant = $this->seedPlantRepo->find($seedPlant->id);
        $dbSeedPlant = $dbSeedPlant->toArray();
        $this->assertModelData($seedPlant->toArray(), $dbSeedPlant);
    }

    /**
     * @test update
     */
    public function test_update_seed_plant()
    {
        $seedPlant = $this->makeSeedPlant();
        $fakeSeedPlant = $this->fakeSeedPlantData();
        $updatedSeedPlant = $this->seedPlantRepo->update($fakeSeedPlant, $seedPlant->id);
        $this->assertModelData($fakeSeedPlant, $updatedSeedPlant->toArray());
        $dbSeedPlant = $this->seedPlantRepo->find($seedPlant->id);
        $this->assertModelData($fakeSeedPlant, $dbSeedPlant->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_seed_plant()
    {
        $seedPlant = $this->makeSeedPlant();
        $resp = $this->seedPlantRepo->delete($seedPlant->id);
        $this->assertTrue($resp);
        $this->assertNull(SeedPlant::find($seedPlant->id), 'SeedPlant should not exist in DB');
    }
}
