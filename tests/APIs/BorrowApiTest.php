<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBorrowTrait;
use Tests\ApiTestTrait;

class BorrowApiTest extends TestCase
{
    use MakeBorrowTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_borrow()
    {
        $borrow = $this->fakeBorrowData();
        $this->response = $this->json('POST', '/api/borrows', $borrow);

        $this->assertApiResponse($borrow);
    }

    /**
     * @test
     */
    public function test_read_borrow()
    {
        $borrow = $this->makeBorrow();
        $this->response = $this->json('GET', '/api/borrows/'.$borrow->id);

        $this->assertApiResponse($borrow->toArray());
    }

    /**
     * @test
     */
    public function test_update_borrow()
    {
        $borrow = $this->makeBorrow();
        $editedBorrow = $this->fakeBorrowData();

        $this->response = $this->json('PUT', '/api/borrows/'.$borrow->id, $editedBorrow);

        $this->assertApiResponse($editedBorrow);
    }

    /**
     * @test
     */
    public function test_delete_borrow()
    {
        $borrow = $this->makeBorrow();
        $this->response = $this->json('DELETE', '/api/borrows/'.$borrow->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/borrows/'.$borrow->id);

        $this->response->assertStatus(404);
    }
}
