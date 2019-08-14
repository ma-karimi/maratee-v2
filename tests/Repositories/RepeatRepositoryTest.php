<?php namespace Tests\Repositories;

use App\Models\Repeat;
use App\Repositories\RepeatRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeRepeatTrait;
use Tests\ApiTestTrait;

class RepeatRepositoryTest extends TestCase
{
    use MakeRepeatTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var RepeatRepository
     */
    protected $repeatRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->repeatRepo = \App::make(RepeatRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_repeat()
    {
        $repeat = $this->fakeRepeatData();
        $createdRepeat = $this->repeatRepo->create($repeat);
        $createdRepeat = $createdRepeat->toArray();
        $this->assertArrayHasKey('id', $createdRepeat);
        $this->assertNotNull($createdRepeat['id'], 'Created Repeat must have id specified');
        $this->assertNotNull(Repeat::find($createdRepeat['id']), 'Repeat with given id must be in DB');
        $this->assertModelData($repeat, $createdRepeat);
    }

    /**
     * @test read
     */
    public function test_read_repeat()
    {
        $repeat = $this->makeRepeat();
        $dbRepeat = $this->repeatRepo->find($repeat->id);
        $dbRepeat = $dbRepeat->toArray();
        $this->assertModelData($repeat->toArray(), $dbRepeat);
    }

    /**
     * @test update
     */
    public function test_update_repeat()
    {
        $repeat = $this->makeRepeat();
        $fakeRepeat = $this->fakeRepeatData();
        $updatedRepeat = $this->repeatRepo->update($fakeRepeat, $repeat->id);
        $this->assertModelData($fakeRepeat, $updatedRepeat->toArray());
        $dbRepeat = $this->repeatRepo->find($repeat->id);
        $this->assertModelData($fakeRepeat, $dbRepeat->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_repeat()
    {
        $repeat = $this->makeRepeat();
        $resp = $this->repeatRepo->delete($repeat->id);
        $this->assertTrue($resp);
        $this->assertNull(Repeat::find($repeat->id), 'Repeat should not exist in DB');
    }
}
