<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeEntryHubTrait;
use Tests\ApiTestTrait;

class EntryHubApiTest extends TestCase
{
    use MakeEntryHubTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_entry_hub()
    {
        $entryHub = $this->fakeEntryHubData();
        $this->response = $this->json('POST', '/api/entryHubs', $entryHub);

        $this->assertApiResponse($entryHub);
    }

    /**
     * @test
     */
    public function test_read_entry_hub()
    {
        $entryHub = $this->makeEntryHub();
        $this->response = $this->json('GET', '/api/entryHubs/'.$entryHub->id);

        $this->assertApiResponse($entryHub->toArray());
    }

    /**
     * @test
     */
    public function test_update_entry_hub()
    {
        $entryHub = $this->makeEntryHub();
        $editedEntryHub = $this->fakeEntryHubData();

        $this->response = $this->json('PUT', '/api/entryHubs/'.$entryHub->id, $editedEntryHub);

        $this->assertApiResponse($editedEntryHub);
    }

    /**
     * @test
     */
    public function test_delete_entry_hub()
    {
        $entryHub = $this->makeEntryHub();
        $this->response = $this->json('DELETE', '/api/entryHubs/'.$entryHub->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/entryHubs/'.$entryHub->id);

        $this->response->assertStatus(404);
    }
}
