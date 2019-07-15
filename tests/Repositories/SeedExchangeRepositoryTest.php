<?php namespace Tests\Repositories;

use App\Models\SeedExchange;
use App\Repositories\SeedExchangeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSeedExchangeTrait;
use Tests\ApiTestTrait;

class SeedExchangeRepositoryTest extends TestCase
{
    use MakeSeedExchangeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SeedExchangeRepository
     */
    protected $seedExchangeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->seedExchangeRepo = \App::make(SeedExchangeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_seed_exchange()
    {
        $seedExchange = $this->fakeSeedExchangeData();
        $createdSeedExchange = $this->seedExchangeRepo->create($seedExchange);
        $createdSeedExchange = $createdSeedExchange->toArray();
        $this->assertArrayHasKey('id', $createdSeedExchange);
        $this->assertNotNull($createdSeedExchange['id'], 'Created SeedExchange must have id specified');
        $this->assertNotNull(SeedExchange::find($createdSeedExchange['id']), 'SeedExchange with given id must be in DB');
        $this->assertModelData($seedExchange, $createdSeedExchange);
    }

    /**
     * @test read
     */
    public function test_read_seed_exchange()
    {
        $seedExchange = $this->makeSeedExchange();
        $dbSeedExchange = $this->seedExchangeRepo->find($seedExchange->id);
        $dbSeedExchange = $dbSeedExchange->toArray();
        $this->assertModelData($seedExchange->toArray(), $dbSeedExchange);
    }

    /**
     * @test update
     */
    public function test_update_seed_exchange()
    {
        $seedExchange = $this->makeSeedExchange();
        $fakeSeedExchange = $this->fakeSeedExchangeData();
        $updatedSeedExchange = $this->seedExchangeRepo->update($fakeSeedExchange, $seedExchange->id);
        $this->assertModelData($fakeSeedExchange, $updatedSeedExchange->toArray());
        $dbSeedExchange = $this->seedExchangeRepo->find($seedExchange->id);
        $this->assertModelData($fakeSeedExchange, $dbSeedExchange->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_seed_exchange()
    {
        $seedExchange = $this->makeSeedExchange();
        $resp = $this->seedExchangeRepo->delete($seedExchange->id);
        $this->assertTrue($resp);
        $this->assertNull(SeedExchange::find($seedExchange->id), 'SeedExchange should not exist in DB');
    }
}
