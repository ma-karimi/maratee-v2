<?php namespace Tests\Repositories;

use App\Models\Borrow;
use App\Repositories\BorrowRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBorrowTrait;
use Tests\ApiTestTrait;

class BorrowRepositoryTest extends TestCase
{
    use MakeBorrowTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BorrowRepository
     */
    protected $borrowRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->borrowRepo = \App::make(BorrowRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_borrow()
    {
        $borrow = $this->fakeBorrowData();
        $createdBorrow = $this->borrowRepo->create($borrow);
        $createdBorrow = $createdBorrow->toArray();
        $this->assertArrayHasKey('id', $createdBorrow);
        $this->assertNotNull($createdBorrow['id'], 'Created Borrow must have id specified');
        $this->assertNotNull(Borrow::find($createdBorrow['id']), 'Borrow with given id must be in DB');
        $this->assertModelData($borrow, $createdBorrow);
    }

    /**
     * @test read
     */
    public function test_read_borrow()
    {
        $borrow = $this->makeBorrow();
        $dbBorrow = $this->borrowRepo->find($borrow->id);
        $dbBorrow = $dbBorrow->toArray();
        $this->assertModelData($borrow->toArray(), $dbBorrow);
    }

    /**
     * @test update
     */
    public function test_update_borrow()
    {
        $borrow = $this->makeBorrow();
        $fakeBorrow = $this->fakeBorrowData();
        $updatedBorrow = $this->borrowRepo->update($fakeBorrow, $borrow->id);
        $this->assertModelData($fakeBorrow, $updatedBorrow->toArray());
        $dbBorrow = $this->borrowRepo->find($borrow->id);
        $this->assertModelData($fakeBorrow, $dbBorrow->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_borrow()
    {
        $borrow = $this->makeBorrow();
        $resp = $this->borrowRepo->delete($borrow->id);
        $this->assertTrue($resp);
        $this->assertNull(Borrow::find($borrow->id), 'Borrow should not exist in DB');
    }
}
