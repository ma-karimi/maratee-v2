<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeRepeatTrait;
use Tests\ApiTestTrait;

class RepeatApiTest extends TestCase
{
    use MakeRepeatTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_repeat()
    {
        $repeat = $this->fakeRepeatData();
        $this->response = $this->json('POST', '/api/repeats', $repeat);

        $this->assertApiResponse($repeat);
    }

    /**
     * @test
     */
    public function test_read_repeat()
    {
        $repeat = $this->makeRepeat();
        $this->response = $this->json('GET', '/api/repeats/'.$repeat->id);

        $this->assertApiResponse($repeat->toArray());
    }

    /**
     * @test
     */
    public function test_update_repeat()
    {
        $repeat = $this->makeRepeat();
        $editedRepeat = $this->fakeRepeatData();

        $this->response = $this->json('PUT', '/api/repeats/'.$repeat->id, $editedRepeat);

        $this->assertApiResponse($editedRepeat);
    }

    /**
     * @test
     */
    public function test_delete_repeat()
    {
        $repeat = $this->makeRepeat();
        $this->response = $this->json('DELETE', '/api/repeats/'.$repeat->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/repeats/'.$repeat->id);

        $this->response->assertStatus(404);
    }
}
