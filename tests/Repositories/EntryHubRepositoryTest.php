<?php namespace Tests\Repositories;

use App\Models\EntryHub;
use App\Repositories\EntryHubRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeEntryHubTrait;
use Tests\ApiTestTrait;

class EntryHubRepositoryTest extends TestCase
{
    use MakeEntryHubTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var EntryHubRepository
     */
    protected $entryHubRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->entryHubRepo = \App::make(EntryHubRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_entry_hub()
    {
        $entryHub = $this->fakeEntryHubData();
        $createdEntryHub = $this->entryHubRepo->create($entryHub);
        $createdEntryHub = $createdEntryHub->toArray();
        $this->assertArrayHasKey('id', $createdEntryHub);
        $this->assertNotNull($createdEntryHub['id'], 'Created EntryHub must have id specified');
        $this->assertNotNull(EntryHub::find($createdEntryHub['id']), 'EntryHub with given id must be in DB');
        $this->assertModelData($entryHub, $createdEntryHub);
    }

    /**
     * @test read
     */
    public function test_read_entry_hub()
    {
        $entryHub = $this->makeEntryHub();
        $dbEntryHub = $this->entryHubRepo->find($entryHub->id);
        $dbEntryHub = $dbEntryHub->toArray();
        $this->assertModelData($entryHub->toArray(), $dbEntryHub);
    }

    /**
     * @test update
     */
    public function test_update_entry_hub()
    {
        $entryHub = $this->makeEntryHub();
        $fakeEntryHub = $this->fakeEntryHubData();
        $updatedEntryHub = $this->entryHubRepo->update($fakeEntryHub, $entryHub->id);
        $this->assertModelData($fakeEntryHub, $updatedEntryHub->toArray());
        $dbEntryHub = $this->entryHubRepo->find($entryHub->id);
        $this->assertModelData($fakeEntryHub, $dbEntryHub->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_entry_hub()
    {
        $entryHub = $this->makeEntryHub();
        $resp = $this->entryHubRepo->delete($entryHub->id);
        $this->assertTrue($resp);
        $this->assertNull(EntryHub::find($entryHub->id), 'EntryHub should not exist in DB');
    }
}
