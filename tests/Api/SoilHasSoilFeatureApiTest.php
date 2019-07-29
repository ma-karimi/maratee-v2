<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeSoilHasSoilFeatureTrait;
use Tests\ApiTestTrait;

class SoilHasSoilFeatureApiTest extends TestCase
{
    use MakeSoilHasSoilFeatureTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_soil_has_soil_feature()
    {
        $soilHasSoilFeature = $this->fakeSoilHasSoilFeatureData();
        $this->response = $this->json('POST', '/api/soilHasSoilFeatures', $soilHasSoilFeature);

        $this->assertApiResponse($soilHasSoilFeature);
    }

    /**
     * @test
     */
    public function test_read_soil_has_soil_feature()
    {
        $soilHasSoilFeature = $this->makeSoilHasSoilFeature();
        $this->response = $this->json('GET', '/api/soilHasSoilFeatures/'.$soilHasSoilFeature->id);

        $this->assertApiResponse($soilHasSoilFeature->toArray());
    }

    /**
     * @test
     */
    public function test_update_soil_has_soil_feature()
    {
        $soilHasSoilFeature = $this->makeSoilHasSoilFeature();
        $editedSoilHasSoilFeature = $this->fakeSoilHasSoilFeatureData();

        $this->response = $this->json('PUT', '/api/soilHasSoilFeatures/'.$soilHasSoilFeature->id, $editedSoilHasSoilFeature);

        $this->assertApiResponse($editedSoilHasSoilFeature);
    }

    /**
     * @test
     */
    public function test_delete_soil_has_soil_feature()
    {
        $soilHasSoilFeature = $this->makeSoilHasSoilFeature();
        $this->response = $this->json('DELETE', '/api/soilHasSoilFeatures/'.$soilHasSoilFeature->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/soilHasSoilFeatures/'.$soilHasSoilFeature->id);

        $this->response->assertStatus(404);
    }
}
