<?php namespace Tests\Repositories;

use App\Models\BlockTrait;
use App\Repositories\BlockTraitRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBlockTraitTrait;
use Tests\ApiTestTrait;

class BlockTraitRepositoryTest extends TestCase
{
    use MakeBlockTraitTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BlockTraitRepository
     */
    protected $blockTraitRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->blockTraitRepo = \App::make(BlockTraitRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_block_trait()
    {
        $blockTrait = $this->fakeBlockTraitData();
        $createdBlockTrait = $this->blockTraitRepo->create($blockTrait);
        $createdBlockTrait = $createdBlockTrait->toArray();
        $this->assertArrayHasKey('id', $createdBlockTrait);
        $this->assertNotNull($createdBlockTrait['id'], 'Created BlockTrait must have id specified');
        $this->assertNotNull(BlockTrait::find($createdBlockTrait['id']), 'BlockTrait with given id must be in DB');
        $this->assertModelData($blockTrait, $createdBlockTrait);
    }

    /**
     * @test read
     */
    public function test_read_block_trait()
    {
        $blockTrait = $this->makeBlockTrait();
        $dbBlockTrait = $this->blockTraitRepo->find($blockTrait->id);
        $dbBlockTrait = $dbBlockTrait->toArray();
        $this->assertModelData($blockTrait->toArray(), $dbBlockTrait);
    }

    /**
     * @test update
     */
    public function test_update_block_trait()
    {
        $blockTrait = $this->makeBlockTrait();
        $fakeBlockTrait = $this->fakeBlockTraitData();
        $updatedBlockTrait = $this->blockTraitRepo->update($fakeBlockTrait, $blockTrait->id);
        $this->assertModelData($fakeBlockTrait, $updatedBlockTrait->toArray());
        $dbBlockTrait = $this->blockTraitRepo->find($blockTrait->id);
        $this->assertModelData($fakeBlockTrait, $dbBlockTrait->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_block_trait()
    {
        $blockTrait = $this->makeBlockTrait();
        $resp = $this->blockTraitRepo->delete($blockTrait->id);
        $this->assertTrue($resp);
        $this->assertNull(BlockTrait::find($blockTrait->id), 'BlockTrait should not exist in DB');
    }
}
