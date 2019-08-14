<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBlockTrait;
use Tests\ApiTestTrait;

class BlockApiTest extends TestCase
{
    use MakeBlockTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_block()
    {
        $block = $this->fakeBlockData();
        $this->response = $this->json('POST', '/api/blocks', $block);

        $this->assertApiResponse($block);
    }

    /**
     * @test
     */
    public function test_read_block()
    {
        $block = $this->makeBlock();
        $this->response = $this->json('GET', '/api/blocks/'.$block->id);

        $this->assertApiResponse($block->toArray());
    }

    /**
     * @test
     */
    public function test_update_block()
    {
        $block = $this->makeBlock();
        $editedBlock = $this->fakeBlockData();

        $this->response = $this->json('PUT', '/api/blocks/'.$block->id, $editedBlock);

        $this->assertApiResponse($editedBlock);
    }

    /**
     * @test
     */
    public function test_delete_block()
    {
        $block = $this->makeBlock();
        $this->response = $this->json('DELETE', '/api/blocks/'.$block->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/blocks/'.$block->id);

        $this->response->assertStatus(404);
    }
}
