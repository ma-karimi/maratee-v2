<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Seed;

class SeedApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_seed()
    {
        $seed = factory(Seed::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/seeds', $seed
        );

        $this->assertApiResponse($seed);
    }

    /**
     * @test
     */
    public function test_read_seed()
    {
        $seed = factory(Seed::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/seeds/'.$seed->id
        );

        $this->assertApiResponse($seed->toArray());
    }

    /**
     * @test
     */
    public function test_update_seed()
    {
        $seed = factory(Seed::class)->create();
        $editedSeed = factory(Seed::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/seeds/'.$seed->id,
            $editedSeed
        );

        $this->assertApiResponse($editedSeed);
    }

    /**
     * @test
     */
    public function test_delete_seed()
    {
        $seed = factory(Seed::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/seeds/'.$seed->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/seeds/'.$seed->id
        );

        $this->response->assertStatus(404);
    }
}
