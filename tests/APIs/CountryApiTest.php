<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeCountryTrait;
use Tests\ApiTestTrait;

class CountryApiTest extends TestCase
{
    use MakeCountryTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_country()
    {
        $country = $this->fakeCountryData();
        $this->response = $this->json('POST', '/api/countries', $country);

        $this->assertApiResponse($country);
    }

    /**
     * @test
     */
    public function test_read_country()
    {
        $country = $this->makeCountry();
        $this->response = $this->json('GET', '/api/countries/'.$country->id);

        $this->assertApiResponse($country->toArray());
    }

    /**
     * @test
     */
    public function test_update_country()
    {
        $country = $this->makeCountry();
        $editedCountry = $this->fakeCountryData();

        $this->response = $this->json('PUT', '/api/countries/'.$country->id, $editedCountry);

        $this->assertApiResponse($editedCountry);
    }

    /**
     * @test
     */
    public function test_delete_country()
    {
        $country = $this->makeCountry();
        $this->response = $this->json('DELETE', '/api/countries/'.$country->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/countries/'.$country->id);

        $this->response->assertStatus(404);
    }
}
