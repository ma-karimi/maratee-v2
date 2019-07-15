<?php namespace Tests\Repositories;

use App\Models\Geramin;
use App\Repositories\GeraminRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeGeraminTrait;
use Tests\ApiTestTrait;

class GeraminRepositoryTest extends TestCase
{
    use MakeGeraminTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var GeraminRepository
     */
    protected $geraminRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->geraminRepo = \App::make(GeraminRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_geramin()
    {
        $geramin = $this->fakeGeraminData();
        $createdGeramin = $this->geraminRepo->create($geramin);
        $createdGeramin = $createdGeramin->toArray();
        $this->assertArrayHasKey('id', $createdGeramin);
        $this->assertNotNull($createdGeramin['id'], 'Created Geramin must have id specified');
        $this->assertNotNull(Geramin::find($createdGeramin['id']), 'Geramin with given id must be in DB');
        $this->assertModelData($geramin, $createdGeramin);
    }

    /**
     * @test read
     */
    public function test_read_geramin()
    {
        $geramin = $this->makeGeramin();
        $dbGeramin = $this->geraminRepo->find($geramin->id);
        $dbGeramin = $dbGeramin->toArray();
        $this->assertModelData($geramin->toArray(), $dbGeramin);
    }

    /**
     * @test update
     */
    public function test_update_geramin()
    {
        $geramin = $this->makeGeramin();
        $fakeGeramin = $this->fakeGeraminData();
        $updatedGeramin = $this->geraminRepo->update($fakeGeramin, $geramin->id);
        $this->assertModelData($fakeGeramin, $updatedGeramin->toArray());
        $dbGeramin = $this->geraminRepo->find($geramin->id);
        $this->assertModelData($fakeGeramin, $dbGeramin->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_geramin()
    {
        $geramin = $this->makeGeramin();
        $resp = $this->geraminRepo->delete($geramin->id);
        $this->assertTrue($resp);
        $this->assertNull(Geramin::find($geramin->id), 'Geramin should not exist in DB');
    }
}
