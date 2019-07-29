<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeAddressTrait;
use Tests\ApiTestTrait;

class AddressApiTest extends TestCase
{
    use MakeAddressTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_address()
    {
        $address = $this->fakeAddressData();
        $this->response = $this->json('POST', '/api/addresses', $address);

        $this->assertApiResponse($address);
    }

    /**
     * @test
     */
    public function test_read_address()
    {
        $address = $this->makeAddress();
        $this->response = $this->json('GET', '/api/addresses/'.$address->id);

        $this->assertApiResponse($address->toArray());
    }

    /**
     * @test
     */
    public function test_update_address()
    {
        $address = $this->makeAddress();
        $editedAddress = $this->fakeAddressData();

        $this->response = $this->json('PUT', '/api/addresses/'.$address->id, $editedAddress);

        $this->assertApiResponse($editedAddress);
    }

    /**
     * @test
     */
    public function test_delete_address()
    {
        $address = $this->makeAddress();
        $this->response = $this->json('DELETE', '/api/addresses/'.$address->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/addresses/'.$address->id);

        $this->response->assertStatus(404);
    }
}
