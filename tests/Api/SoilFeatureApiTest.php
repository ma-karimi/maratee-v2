<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSoilFeatureTrait;
use Tests\ApiTestTrait;

class SoilFeatureApiTest extends TestCase
{
    use MakeSoilFeatureTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_soil_feature()
    {
        $soilFeature = $this->fakeSoilFeatureData();
        $this->response = $this->json('POST', '/api/soilFeatures', $soilFeature);

        $this->assertApiResponse($soilFeature);
    }

    /**
     * @test
     */
    public function test_read_soil_feature()
    {
        $soilFeature = $this->makeSoilFeature();
        $this->response = $this->json('GET', '/api/soilFeatures/'.$soilFeature->id);

        $this->assertApiResponse($soilFeature->toArray());
    }

    /**
     * @test
     */
    public function test_update_soil_feature()
    {
        $soilFeature = $this->makeSoilFeature();
        $editedSoilFeature = $this->fakeSoilFeatureData();

        $this->response = $this->json('PUT', '/api/soilFeatures/'.$soilFeature->id, $editedSoilFeature);

        $this->assertApiResponse($editedSoilFeature);
    }

    /**
     * @test
     */
    public function test_delete_soil_feature()
    {
        $soilFeature = $this->makeSoilFeature();
        $this->response = $this->json('DELETE', '/api/soilFeatures/'.$soilFeature->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/soilFeatures/'.$soilFeature->id);

        $this->response->assertStatus(404);
    }
}
