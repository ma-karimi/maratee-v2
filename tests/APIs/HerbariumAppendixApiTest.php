<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeHerbariumAppendixTrait;
use Tests\ApiTestTrait;

class HerbariumAppendixApiTest extends TestCase
{
    use MakeHerbariumAppendixTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_herbarium_appendix()
    {
        $herbariumAppendix = $this->fakeHerbariumAppendixData();
        $this->response = $this->json('POST', '/api/herbariumAppendixes', $herbariumAppendix);

        $this->assertApiResponse($herbariumAppendix);
    }

    /**
     * @test
     */
    public function test_read_herbarium_appendix()
    {
        $herbariumAppendix = $this->makeHerbariumAppendix();
        $this->response = $this->json('GET', '/api/herbariumAppendixes/'.$herbariumAppendix->id);

        $this->assertApiResponse($herbariumAppendix->toArray());
    }

    /**
     * @test
     */
    public function test_update_herbarium_appendix()
    {
        $herbariumAppendix = $this->makeHerbariumAppendix();
        $editedHerbariumAppendix = $this->fakeHerbariumAppendixData();

        $this->response = $this->json('PUT', '/api/herbariumAppendixes/'.$herbariumAppendix->id, $editedHerbariumAppendix);

        $this->assertApiResponse($editedHerbariumAppendix);
    }

    /**
     * @test
     */
    public function test_delete_herbarium_appendix()
    {
        $herbariumAppendix = $this->makeHerbariumAppendix();
        $this->response = $this->json('DELETE', '/api/herbariumAppendixes/'.$herbariumAppendix->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/herbariumAppendixes/'.$herbariumAppendix->id);

        $this->response->assertStatus(404);
    }
}
