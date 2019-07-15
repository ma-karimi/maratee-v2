<?php namespace Tests\Repositories;

use App\Models\Exchange;
use App\Repositories\ExchangeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeExchangeTrait;
use Tests\ApiTestTrait;

class ExchangeRepositoryTest extends TestCase
{
    use MakeExchangeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ExchangeRepository
     */
    protected $exchangeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->exchangeRepo = \App::make(ExchangeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_exchange()
    {
        $exchange = $this->fakeExchangeData();
        $createdExchange = $this->exchangeRepo->create($exchange);
        $createdExchange = $createdExchange->toArray();
        $this->assertArrayHasKey('id', $createdExchange);
        $this->assertNotNull($createdExchange['id'], 'Created Exchange must have id specified');
        $this->assertNotNull(Exchange::find($createdExchange['id']), 'Exchange with given id must be in DB');
        $this->assertModelData($exchange, $createdExchange);
    }

    /**
     * @test read
     */
    public function test_read_exchange()
    {
        $exchange = $this->makeExchange();
        $dbExchange = $this->exchangeRepo->find($exchange->id);
        $dbExchange = $dbExchange->toArray();
        $this->assertModelData($exchange->toArray(), $dbExchange);
    }

    /**
     * @test update
     */
    public function test_update_exchange()
    {
        $exchange = $this->makeExchange();
        $fakeExchange = $this->fakeExchangeData();
        $updatedExchange = $this->exchangeRepo->update($fakeExchange, $exchange->id);
        $this->assertModelData($fakeExchange, $updatedExchange->toArray());
        $dbExchange = $this->exchangeRepo->find($exchange->id);
        $this->assertModelData($fakeExchange, $dbExchange->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_exchange()
    {
        $exchange = $this->makeExchange();
        $resp = $this->exchangeRepo->delete($exchange->id);
        $this->assertTrue($resp);
        $this->assertNull(Exchange::find($exchange->id), 'Exchange should not exist in DB');
    }
}
