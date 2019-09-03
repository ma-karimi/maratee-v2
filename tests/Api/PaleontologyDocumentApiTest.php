<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\PaleontologyDocument;

class PaleontologyDocumentApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_paleontology_document()
    {
        $paleontologyDocument = factory(PaleontologyDocument::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/paleontology_documents', $paleontologyDocument
        );

        $this->assertApiResponse($paleontologyDocument);
    }

    /**
     * @test
     */
    public function test_read_paleontology_document()
    {
        $paleontologyDocument = factory(PaleontologyDocument::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/paleontology_documents/'.$paleontologyDocument->id
        );

        $this->assertApiResponse($paleontologyDocument->toArray());
    }

    /**
     * @test
     */
    public function test_update_paleontology_document()
    {
        $paleontologyDocument = factory(PaleontologyDocument::class)->create();
        $editedPaleontologyDocument = factory(PaleontologyDocument::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/paleontology_documents/'.$paleontologyDocument->id,
            $editedPaleontologyDocument
        );

        $this->assertApiResponse($editedPaleontologyDocument);
    }

    /**
     * @test
     */
    public function test_delete_paleontology_document()
    {
        $paleontologyDocument = factory(PaleontologyDocument::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/paleontology_documents/'.$paleontologyDocument->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/paleontology_documents/'.$paleontologyDocument->id
        );

        $this->response->assertStatus(404);
    }
}
