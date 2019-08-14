<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeTraitValueTrait;
use Tests\ApiTestTrait;

class TraitValueApiTest extends TestCase
{
    use MakeTraitValueTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_trait_value()
    {
        $traitValue = $this->fakeTraitValueData();
        $this->response = $this->json('POST', '/api/traitValues', $traitValue);

        $this->assertApiResponse($traitValue);
    }

    /**
     * @test
     */
    public function test_read_trait_value()
    {
        $traitValue = $this->makeTraitValue();
        $this->response = $this->json('GET', '/api/traitValues/'.$traitValue->id);

        $this->assertApiResponse($traitValue->toArray());
    }

    /**
     * @test
     */
    public function test_update_trait_value()
    {
        $traitValue = $this->makeTraitValue();
        $editedTraitValue = $this->fakeTraitValueData();

        $this->response = $this->json('PUT', '/api/traitValues/'.$traitValue->id, $editedTraitValue);

        $this->assertApiResponse($editedTraitValue);
    }

    /**
     * @test
     */
    public function test_delete_trait_value()
    {
        $traitValue = $this->makeTraitValue();
        $this->response = $this->json('DELETE', '/api/traitValues/'.$traitValue->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/traitValues/'.$traitValue->id);

        $this->response->assertStatus(404);
    }
}
