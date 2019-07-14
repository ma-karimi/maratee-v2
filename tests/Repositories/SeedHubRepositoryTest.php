<?php namespace Tests\Repositories;

use App\Models\SeedHub;
use App\Repositories\SeedHubRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSeedHubTrait;
use Tests\ApiTestTrait;

class SeedHubRepositoryTest extends TestCase
{
    use MakeSeedHubTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SeedHubRepository
     */
    protected $seedHubRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->seedHubRepo = \App::make(SeedHubRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_seed_hub()
    {
        $seedHub = $this->fakeSeedHubData();
        $createdSeedHub = $this->seedHubRepo->create($seedHub);
        $createdSeedHub = $createdSeedHub->toArray();
        $this->assertArrayHasKey('id', $createdSeedHub);
        $this->assertNotNull($createdSeedHub['id'], 'Created SeedHub must have id specified');
        $this->assertNotNull(SeedHub::find($createdSeedHub['id']), 'SeedHub with given id must be in DB');
        $this->assertModelData($seedHub, $createdSeedHub);
    }

    /**
     * @test read
     */
    public function test_read_seed_hub()
    {
        $seedHub = $this->makeSeedHub();
        $dbSeedHub = $this->seedHubRepo->find($seedHub->id);
        $dbSeedHub = $dbSeedHub->toArray();
        $this->assertModelData($seedHub->toArray(), $dbSeedHub);
    }

    /**
     * @test update
     */
    public function test_update_seed_hub()
    {
        $seedHub = $this->makeSeedHub();
        $fakeSeedHub = $this->fakeSeedHubData();
        $updatedSeedHub = $this->seedHubRepo->update($fakeSeedHub, $seedHub->id);
        $this->assertModelData($fakeSeedHub, $updatedSeedHub->toArray());
        $dbSeedHub = $this->seedHubRepo->find($seedHub->id);
        $this->assertModelData($fakeSeedHub, $dbSeedHub->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_seed_hub()
    {
        $seedHub = $this->makeSeedHub();
        $resp = $this->seedHubRepo->delete($seedHub->id);
        $this->assertTrue($resp);
        $this->assertNull(SeedHub::find($seedHub->id), 'SeedHub should not exist in DB');
    }
}
