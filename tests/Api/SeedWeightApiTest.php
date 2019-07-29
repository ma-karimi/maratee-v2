<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSeedWeightTrait;
use Tests\ApiTestTrait;

class SeedWeightApiTest extends TestCase
{
    use MakeSeedWeightTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_seed_weight()
    {
        $seedWeight = $this->fakeSeedWeightData();
        $this->response = $this->json('POST', '/api/seedWeights', $seedWeight);

        $this->assertApiResponse($seedWeight);
    }

    /**
     * @test
     */
    public function test_read_seed_weight()
    {
        $seedWeight = $this->makeSeedWeight();
        $this->response = $this->json('GET', '/api/seedWeights/'.$seedWeight->id);

        $this->assertApiResponse($seedWeight->toArray());
    }

    /**
     * @test
     */
    public function test_update_seed_weight()
    {
        $seedWeight = $this->makeSeedWeight();
        $editedSeedWeight = $this->fakeSeedWeightData();

        $this->response = $this->json('PUT', '/api/seedWeights/'.$seedWeight->id, $editedSeedWeight);

        $this->assertApiResponse($editedSeedWeight);
    }

    /**
     * @test
     */
    public function test_delete_seed_weight()
    {
        $seedWeight = $this->makeSeedWeight();
        $this->response = $this->json('DELETE', '/api/seedWeights/'.$seedWeight->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/seedWeights/'.$seedWeight->id);

        $this->response->assertStatus(404);
    }
}
