<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeTaxonomyTrait;
use Tests\ApiTestTrait;

class TaxonomyApiTest extends TestCase
{
    use MakeTaxonomyTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_taxonomy()
    {
        $taxonomy = $this->fakeTaxonomyData();
        $this->response = $this->json('POST', '/api/taxonomies', $taxonomy);

        $this->assertApiResponse($taxonomy);
    }

    /**
     * @test
     */
    public function test_read_taxonomy()
    {
        $taxonomy = $this->makeTaxonomy();
        $this->response = $this->json('GET', '/api/taxonomies/'.$taxonomy->id);

        $this->assertApiResponse($taxonomy->toArray());
    }

    /**
     * @test
     */
    public function test_update_taxonomy()
    {
        $taxonomy = $this->makeTaxonomy();
        $editedTaxonomy = $this->fakeTaxonomyData();

        $this->response = $this->json('PUT', '/api/taxonomies/'.$taxonomy->id, $editedTaxonomy);

        $this->assertApiResponse($editedTaxonomy);
    }

    /**
     * @test
     */
    public function test_delete_taxonomy()
    {
        $taxonomy = $this->makeTaxonomy();
        $this->response = $this->json('DELETE', '/api/taxonomies/'.$taxonomy->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/taxonomies/'.$taxonomy->id);

        $this->response->assertStatus(404);
    }
}
