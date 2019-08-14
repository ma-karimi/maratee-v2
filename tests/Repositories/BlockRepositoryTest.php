<?php namespace Tests\Repositories;

use App\Models\Block;
use App\Repositories\BlockRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBlockTrait;
use Tests\ApiTestTrait;

class BlockRepositoryTest extends TestCase
{
    use MakeBlockTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BlockRepository
     */
    protected $blockRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->blockRepo = \App::make(BlockRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_block()
    {
        $block = $this->fakeBlockData();
        $createdBlock = $this->blockRepo->create($block);
        $createdBlock = $createdBlock->toArray();
        $this->assertArrayHasKey('id', $createdBlock);
        $this->assertNotNull($createdBlock['id'], 'Created Block must have id specified');
        $this->assertNotNull(Block::find($createdBlock['id']), 'Block with given id must be in DB');
        $this->assertModelData($block, $createdBlock);
    }

    /**
     * @test read
     */
    public function test_read_block()
    {
        $block = $this->makeBlock();
        $dbBlock = $this->blockRepo->find($block->id);
        $dbBlock = $dbBlock->toArray();
        $this->assertModelData($block->toArray(), $dbBlock);
    }

    /**
     * @test update
     */
    public function test_update_block()
    {
        $block = $this->makeBlock();
        $fakeBlock = $this->fakeBlockData();
        $updatedBlock = $this->blockRepo->update($fakeBlock, $block->id);
        $this->assertModelData($fakeBlock, $updatedBlock->toArray());
        $dbBlock = $this->blockRepo->find($block->id);
        $this->assertModelData($fakeBlock, $dbBlock->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_block()
    {
        $block = $this->makeBlock();
        $resp = $this->blockRepo->delete($block->id);
        $this->assertTrue($resp);
        $this->assertNull(Block::find($block->id), 'Block should not exist in DB');
    }
}
