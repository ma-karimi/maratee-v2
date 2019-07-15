<?php namespace Tests\Repositories;

use App\Models\PaleontologyMedia;
use App\Repositories\PaleontologyMediaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePaleontologyMediaTrait;
use Tests\ApiTestTrait;

class PaleontologyMediaRepositoryTest extends TestCase
{
    use MakePaleontologyMediaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PaleontologyMediaRepository
     */
    protected $paleontologyMediaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->paleontologyMediaRepo = \App::make(PaleontologyMediaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_paleontology_media()
    {
        $paleontologyMedia = $this->fakePaleontologyMediaData();
        $createdPaleontologyMedia = $this->paleontologyMediaRepo->create($paleontologyMedia);
        $createdPaleontologyMedia = $createdPaleontologyMedia->toArray();
        $this->assertArrayHasKey('id', $createdPaleontologyMedia);
        $this->assertNotNull($createdPaleontologyMedia['id'], 'Created PaleontologyMedia must have id specified');
        $this->assertNotNull(PaleontologyMedia::find($createdPaleontologyMedia['id']), 'PaleontologyMedia with given id must be in DB');
        $this->assertModelData($paleontologyMedia, $createdPaleontologyMedia);
    }

    /**
     * @test read
     */
    public function test_read_paleontology_media()
    {
        $paleontologyMedia = $this->makePaleontologyMedia();
        $dbPaleontologyMedia = $this->paleontologyMediaRepo->find($paleontologyMedia->id);
        $dbPaleontologyMedia = $dbPaleontologyMedia->toArray();
        $this->assertModelData($paleontologyMedia->toArray(), $dbPaleontologyMedia);
    }

    /**
     * @test update
     */
    public function test_update_paleontology_media()
    {
        $paleontologyMedia = $this->makePaleontologyMedia();
        $fakePaleontologyMedia = $this->fakePaleontologyMediaData();
        $updatedPaleontologyMedia = $this->paleontologyMediaRepo->update($fakePaleontologyMedia, $paleontologyMedia->id);
        $this->assertModelData($fakePaleontologyMedia, $updatedPaleontologyMedia->toArray());
        $dbPaleontologyMedia = $this->paleontologyMediaRepo->find($paleontologyMedia->id);
        $this->assertModelData($fakePaleontologyMedia, $dbPaleontologyMedia->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_paleontology_media()
    {
        $paleontologyMedia = $this->makePaleontologyMedia();
        $resp = $this->paleontologyMediaRepo->delete($paleontologyMedia->id);
        $this->assertTrue($resp);
        $this->assertNull(PaleontologyMedia::find($paleontologyMedia->id), 'PaleontologyMedia should not exist in DB');
    }
}
