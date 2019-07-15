<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeCollectionTrait;
use Tests\ApiTestTrait;

class CollectionApiTest extends TestCase
{
    use MakeCollectionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_collection()
    {
        $collection = $this->fakeCollectionData();
        $this->response = $this->json('POST', '/api/collections', $collection);

        $this->assertApiResponse($collection);
    }

    /**
     * @test
     */
    public function test_read_collection()
    {
        $collection = $this->makeCollection();
        $this->response = $this->json('GET', '/api/collections/'.$collection->id);

        $this->assertApiResponse($collection->toArray());
    }

    /**
     * @test
     */
    public function test_update_collection()
    {
        $collection = $this->makeCollection();
        $editedCollection = $this->fakeCollectionData();

        $this->response = $this->json('PUT', '/api/collections/'.$collection->id, $editedCollection);

        $this->assertApiResponse($editedCollection);
    }

    /**
     * @test
     */
    public function test_delete_collection()
    {
        $collection = $this->makeCollection();
        $this->response = $this->json('DELETE', '/api/collections/'.$collection->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/collections/'.$collection->id);

        $this->response->assertStatus(404);
    }
}
