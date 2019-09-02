<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TransactionEvidence;

class TransactionEvidenceApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_transaction_evidence()
    {
        $transactionEvidence = factory(TransactionEvidence::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/transaction_evidences', $transactionEvidence
        );

        $this->assertApiResponse($transactionEvidence);
    }

    /**
     * @test
     */
    public function test_read_transaction_evidence()
    {
        $transactionEvidence = factory(TransactionEvidence::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/transaction_evidences/'.$transactionEvidence->id
        );

        $this->assertApiResponse($transactionEvidence->toArray());
    }

    /**
     * @test
     */
    public function test_update_transaction_evidence()
    {
        $transactionEvidence = factory(TransactionEvidence::class)->create();
        $editedTransactionEvidence = factory(TransactionEvidence::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/transaction_evidences/'.$transactionEvidence->id,
            $editedTransactionEvidence
        );

        $this->assertApiResponse($editedTransactionEvidence);
    }

    /**
     * @test
     */
    public function test_delete_transaction_evidence()
    {
        $transactionEvidence = factory(TransactionEvidence::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/transaction_evidences/'.$transactionEvidence->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/transaction_evidences/'.$transactionEvidence->id
        );

        $this->response->assertStatus(404);
    }
}
