<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMorphologyTrait;
use Tests\ApiTestTrait;

class MorphologyApiTest extends TestCase
{
    use MakeMorphologyTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_morphology()
    {
        $morphology = $this->fakeMorphologyData();
        $this->response = $this->json('POST', '/api/morphologies', $morphology);

        $this->assertApiResponse($morphology);
    }

    /**
     * @test
     */
    public function test_read_morphology()
    {
        $morphology = $this->makeMorphology();
        $this->response = $this->json('GET', '/api/morphologies/'.$morphology->id);

        $this->assertApiResponse($morphology->toArray());
    }

    /**
     * @test
     */
    public function test_update_morphology()
    {
        $morphology = $this->makeMorphology();
        $editedMorphology = $this->fakeMorphologyData();

        $this->response = $this->json('PUT', '/api/morphologies/'.$morphology->id, $editedMorphology);

        $this->assertApiResponse($editedMorphology);
    }

    /**
     * @test
     */
    public function test_delete_morphology()
    {
        $morphology = $this->makeMorphology();
        $this->response = $this->json('DELETE', '/api/morphologies/'.$morphology->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/morphologies/'.$morphology->id);

        $this->response->assertStatus(404);
    }
}
