<?php namespace Tests\Repositories;

use App\Models\HerbariumAppendix;
use App\Repositories\HerbariumAppendixRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeHerbariumAppendixTrait;
use Tests\ApiTestTrait;

class HerbariumAppendixRepositoryTest extends TestCase
{
    use MakeHerbariumAppendixTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var HerbariumAppendixRepository
     */
    protected $herbariumAppendixRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->herbariumAppendixRepo = \App::make(HerbariumAppendixRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_herbarium_appendix()
    {
        $herbariumAppendix = $this->fakeHerbariumAppendixData();
        $createdHerbariumAppendix = $this->herbariumAppendixRepo->create($herbariumAppendix);
        $createdHerbariumAppendix = $createdHerbariumAppendix->toArray();
        $this->assertArrayHasKey('id', $createdHerbariumAppendix);
        $this->assertNotNull($createdHerbariumAppendix['id'], 'Created HerbariumAppendix must have id specified');
        $this->assertNotNull(HerbariumAppendix::find($createdHerbariumAppendix['id']), 'HerbariumAppendix with given id must be in DB');
        $this->assertModelData($herbariumAppendix, $createdHerbariumAppendix);
    }

    /**
     * @test read
     */
    public function test_read_herbarium_appendix()
    {
        $herbariumAppendix = $this->makeHerbariumAppendix();
        $dbHerbariumAppendix = $this->herbariumAppendixRepo->find($herbariumAppendix->id);
        $dbHerbariumAppendix = $dbHerbariumAppendix->toArray();
        $this->assertModelData($herbariumAppendix->toArray(), $dbHerbariumAppendix);
    }

    /**
     * @test update
     */
    public function test_update_herbarium_appendix()
    {
        $herbariumAppendix = $this->makeHerbariumAppendix();
        $fakeHerbariumAppendix = $this->fakeHerbariumAppendixData();
        $updatedHerbariumAppendix = $this->herbariumAppendixRepo->update($fakeHerbariumAppendix, $herbariumAppendix->id);
        $this->assertModelData($fakeHerbariumAppendix, $updatedHerbariumAppendix->toArray());
        $dbHerbariumAppendix = $this->herbariumAppendixRepo->find($herbariumAppendix->id);
        $this->assertModelData($fakeHerbariumAppendix, $dbHerbariumAppendix->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_herbarium_appendix()
    {
        $herbariumAppendix = $this->makeHerbariumAppendix();
        $resp = $this->herbariumAppendixRepo->delete($herbariumAppendix->id);
        $this->assertTrue($resp);
        $this->assertNull(HerbariumAppendix::find($herbariumAppendix->id), 'HerbariumAppendix should not exist in DB');
    }
}
