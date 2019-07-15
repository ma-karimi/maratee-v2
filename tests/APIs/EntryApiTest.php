<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeEntryTrait;
use Tests\ApiTestTrait;

class EntryApiTest extends TestCase
{
    use MakeEntryTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_entry()
    {
        $entry = $this->fakeEntryData();
        $this->response = $this->json('POST', '/api/entries', $entry);

        $this->assertApiResponse($entry);
    }

    /**
     * @test
     */
    public function test_read_entry()
    {
        $entry = $this->makeEntry();
        $this->response = $this->json('GET', '/api/entries/'.$entry->id);

        $this->assertApiResponse($entry->toArray());
    }

    /**
     * @test
     */
    public function test_update_entry()
    {
        $entry = $this->makeEntry();
        $editedEntry = $this->fakeEntryData();

        $this->response = $this->json('PUT', '/api/entries/'.$entry->id, $editedEntry);

        $this->assertApiResponse($editedEntry);
    }

    /**
     * @test
     */
    public function test_delete_entry()
    {
        $entry = $this->makeEntry();
        $this->response = $this->json('DELETE', '/api/entries/'.$entry->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/entries/'.$entry->id);

        $this->response->assertStatus(404);
    }
}
