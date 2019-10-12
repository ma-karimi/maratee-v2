<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\SeedCollection;

class SeedCollectionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_seed_collection()
    {
        $seedCollection = factory(SeedCollection::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/seed_collections', $seedCollection
        );

        $this->assertApiResponse($seedCollection);
    }

    /**
     * @test
     */
    public function test_read_seed_collection()
    {
        $seedCollection = factory(SeedCollection::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/seed_collections/'.$seedCollection->id
        );

        $this->assertApiResponse($seedCollection->toArray());
    }

    /**
     * @test
     */
    public function test_update_seed_collection()
    {
        $seedCollection = factory(SeedCollection::class)->create();
        $editedSeedCollection = factory(SeedCollection::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/seed_collections/'.$seedCollection->id,
            $editedSeedCollection
        );

        $this->assertApiResponse($editedSeedCollection);
    }

    /**
     * @test
     */
    public function test_delete_seed_collection()
    {
        $seedCollection = factory(SeedCollection::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/seed_collections/'.$seedCollection->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/seed_collections/'.$seedCollection->id
        );

        $this->response->assertStatus(404);
    }
}
