<?php namespace Tests\Repositories;

use App\Models\SeedHasPlant;
use App\Repositories\SeedHasPlantRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSeedHasPlantTrait;
use Tests\ApiTestTrait;

class SeedHasPlantRepositoryTest extends TestCase
{
    use MakeSeedHasPlantTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SeedHasPlantRepository
     */
    protected $seedHasPlantRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->seedHasPlantRepo = \App::make(SeedHasPlantRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_seed_has_plant()
    {
        $seedHasPlant = $this->fakeSeedHasPlantData();
        $createdSeedHasPlant = $this->seedHasPlantRepo->create($seedHasPlant);
        $createdSeedHasPlant = $createdSeedHasPlant->toArray();
        $this->assertArrayHasKey('id', $createdSeedHasPlant);
        $this->assertNotNull($createdSeedHasPlant['id'], 'Created SeedHasPlant must have id specified');
        $this->assertNotNull(SeedHasPlant::find($createdSeedHasPlant['id']), 'SeedHasPlant with given id must be in DB');
        $this->assertModelData($seedHasPlant, $createdSeedHasPlant);
    }

    /**
     * @test read
     */
    public function test_read_seed_has_plant()
    {
        $seedHasPlant = $this->makeSeedHasPlant();
        $dbSeedHasPlant = $this->seedHasPlantRepo->find($seedHasPlant->id);
        $dbSeedHasPlant = $dbSeedHasPlant->toArray();
        $this->assertModelData($seedHasPlant->toArray(), $dbSeedHasPlant);
    }

    /**
     * @test update
     */
    public function test_update_seed_has_plant()
    {
        $seedHasPlant = $this->makeSeedHasPlant();
        $fakeSeedHasPlant = $this->fakeSeedHasPlantData();
        $updatedSeedHasPlant = $this->seedHasPlantRepo->update($fakeSeedHasPlant, $seedHasPlant->id);
        $this->assertModelData($fakeSeedHasPlant, $updatedSeedHasPlant->toArray());
        $dbSeedHasPlant = $this->seedHasPlantRepo->find($seedHasPlant->id);
        $this->assertModelData($fakeSeedHasPlant, $dbSeedHasPlant->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_seed_has_plant()
    {
        $seedHasPlant = $this->makeSeedHasPlant();
        $resp = $this->seedHasPlantRepo->delete($seedHasPlant->id);
        $this->assertTrue($resp);
        $this->assertNull(SeedHasPlant::find($seedHasPlant->id), 'SeedHasPlant should not exist in DB');
    }
}
