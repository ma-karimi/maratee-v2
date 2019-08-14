<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeseedFeatureTrait;
use Tests\ApiTestTrait;

class seedFeatureApiTest extends TestCase
{
    use MakeseedFeatureTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_seedFeature()
    {
        $seedFeature = $this->fakeseedFeatureData();
        $this->response = $this->json('POST', '/api/seedFeatures', $seedFeature);

        $this->assertApiResponse($seedFeature);
    }

    /**
     * @test
     */
    public function test_read_seedFeature()
    {
        $seedFeature = $this->makeseedFeature();
        $this->response = $this->json('GET', '/api/seedFeatures/'.$seedFeature->id);

        $this->assertApiResponse($seedFeature->toArray());
    }

    /**
     * @test
     */
    public function test_update_seedFeature()
    {
        $seedFeature = $this->makeseedFeature();
        $editedseedFeature = $this->fakeseedFeatureData();

        $this->response = $this->json('PUT', '/api/seedFeatures/'.$seedFeature->id, $editedseedFeature);

        $this->assertApiResponse($editedseedFeature);
    }

    /**
     * @test
     */
    public function test_delete_seedFeature()
    {
        $seedFeature = $this->makeseedFeature();
        $this->response = $this->json('DELETE', '/api/seedFeatures/'.$seedFeature->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/seedFeatures/'.$seedFeature->id);

        $this->response->assertStatus(404);
    }
}
