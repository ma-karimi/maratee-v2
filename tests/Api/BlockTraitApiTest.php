<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBlockTraitTrait;
use Tests\ApiTestTrait;

class BlockTraitApiTest extends TestCase
{
    use MakeBlockTraitTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_block_trait()
    {
        $blockTrait = $this->fakeBlockTraitData();
        $this->response = $this->json('POST', '/api/blockTraits', $blockTrait);

        $this->assertApiResponse($blockTrait);
    }

    /**
     * @test
     */
    public function test_read_block_trait()
    {
        $blockTrait = $this->makeBlockTrait();
        $this->response = $this->json('GET', '/api/blockTraits/'.$blockTrait->id);

        $this->assertApiResponse($blockTrait->toArray());
    }

    /**
     * @test
     */
    public function test_update_block_trait()
    {
        $blockTrait = $this->makeBlockTrait();
        $editedBlockTrait = $this->fakeBlockTraitData();

        $this->response = $this->json('PUT', '/api/blockTraits/'.$blockTrait->id, $editedBlockTrait);

        $this->assertApiResponse($editedBlockTrait);
    }

    /**
     * @test
     */
    public function test_delete_block_trait()
    {
        $blockTrait = $this->makeBlockTrait();
        $this->response = $this->json('DELETE', '/api/blockTraits/'.$blockTrait->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/blockTraits/'.$blockTrait->id);

        $this->response->assertStatus(404);
    }
}
