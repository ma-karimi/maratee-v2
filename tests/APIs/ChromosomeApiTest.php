<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeChromosomeTrait;
use Tests\ApiTestTrait;

class ChromosomeApiTest extends TestCase
{
    use MakeChromosomeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_chromosome()
    {
        $chromosome = $this->fakeChromosomeData();
        $this->response = $this->json('POST', '/api/chromosomes', $chromosome);

        $this->assertApiResponse($chromosome);
    }

    /**
     * @test
     */
    public function test_read_chromosome()
    {
        $chromosome = $this->makeChromosome();
        $this->response = $this->json('GET', '/api/chromosomes/'.$chromosome->id);

        $this->assertApiResponse($chromosome->toArray());
    }

    /**
     * @test
     */
    public function test_update_chromosome()
    {
        $chromosome = $this->makeChromosome();
        $editedChromosome = $this->fakeChromosomeData();

        $this->response = $this->json('PUT', '/api/chromosomes/'.$chromosome->id, $editedChromosome);

        $this->assertApiResponse($editedChromosome);
    }

    /**
     * @test
     */
    public function test_delete_chromosome()
    {
        $chromosome = $this->makeChromosome();
        $this->response = $this->json('DELETE', '/api/chromosomes/'.$chromosome->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/chromosomes/'.$chromosome->id);

        $this->response->assertStatus(404);
    }
}
