<?php namespace Tests\Repositories;

use App\Models\TransactionEvidence;
use App\Repositories\TransactionEvidenceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TransactionEvidenceRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TransactionEvidenceRepository
     */
    protected $transactionEvidenceRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->transactionEvidenceRepo = \App::make(TransactionEvidenceRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_transaction_evidence()
    {
        $transactionEvidence = factory(TransactionEvidence::class)->make()->toArray();

        $createdTransactionEvidence = $this->transactionEvidenceRepo->create($transactionEvidence);

        $createdTransactionEvidence = $createdTransactionEvidence->toArray();
        $this->assertArrayHasKey('id', $createdTransactionEvidence);
        $this->assertNotNull($createdTransactionEvidence['id'], 'Created TransactionEvidence must have id specified');
        $this->assertNotNull(TransactionEvidence::find($createdTransactionEvidence['id']), 'TransactionEvidence with given id must be in DB');
        $this->assertModelData($transactionEvidence, $createdTransactionEvidence);
    }

    /**
     * @test read
     */
    public function test_read_transaction_evidence()
    {
        $transactionEvidence = factory(TransactionEvidence::class)->create();

        $dbTransactionEvidence = $this->transactionEvidenceRepo->find($transactionEvidence->id);

        $dbTransactionEvidence = $dbTransactionEvidence->toArray();
        $this->assertModelData($transactionEvidence->toArray(), $dbTransactionEvidence);
    }

    /**
     * @test update
     */
    public function test_update_transaction_evidence()
    {
        $transactionEvidence = factory(TransactionEvidence::class)->create();
        $fakeTransactionEvidence = factory(TransactionEvidence::class)->make()->toArray();

        $updatedTransactionEvidence = $this->transactionEvidenceRepo->update($fakeTransactionEvidence, $transactionEvidence->id);

        $this->assertModelData($fakeTransactionEvidence, $updatedTransactionEvidence->toArray());
        $dbTransactionEvidence = $this->transactionEvidenceRepo->find($transactionEvidence->id);
        $this->assertModelData($fakeTransactionEvidence, $dbTransactionEvidence->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_transaction_evidence()
    {
        $transactionEvidence = factory(TransactionEvidence::class)->create();

        $resp = $this->transactionEvidenceRepo->delete($transactionEvidence->id);

        $this->assertTrue($resp);
        $this->assertNull(TransactionEvidence::find($transactionEvidence->id), 'TransactionEvidence should not exist in DB');
    }
}
