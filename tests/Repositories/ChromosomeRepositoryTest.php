<?php namespace Tests\Repositories;

use App\Models\Chromosome;
use App\Repositories\ChromosomeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeChromosomeTrait;
use Tests\ApiTestTrait;

class ChromosomeRepositoryTest extends TestCase
{
    use MakeChromosomeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ChromosomeRepository
     */
    protected $chromosomeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->chromosomeRepo = \App::make(ChromosomeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_chromosome()
    {
        $chromosome = $this->fakeChromosomeData();
        $createdChromosome = $this->chromosomeRepo->create($chromosome);
        $createdChromosome = $createdChromosome->toArray();
        $this->assertArrayHasKey('id', $createdChromosome);
        $this->assertNotNull($createdChromosome['id'], 'Created Chromosome must have id specified');
        $this->assertNotNull(Chromosome::find($createdChromosome['id']), 'Chromosome with given id must be in DB');
        $this->assertModelData($chromosome, $createdChromosome);
    }

    /**
     * @test read
     */
    public function test_read_chromosome()
    {
        $chromosome = $this->makeChromosome();
        $dbChromosome = $this->chromosomeRepo->find($chromosome->id);
        $dbChromosome = $dbChromosome->toArray();
        $this->assertModelData($chromosome->toArray(), $dbChromosome);
    }

    /**
     * @test update
     */
    public function test_update_chromosome()
    {
        $chromosome = $this->makeChromosome();
        $fakeChromosome = $this->fakeChromosomeData();
        $updatedChromosome = $this->chromosomeRepo->update($fakeChromosome, $chromosome->id);
        $this->assertModelData($fakeChromosome, $updatedChromosome->toArray());
        $dbChromosome = $this->chromosomeRepo->find($chromosome->id);
        $this->assertModelData($fakeChromosome, $dbChromosome->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_chromosome()
    {
        $chromosome = $this->makeChromosome();
        $resp = $this->chromosomeRepo->delete($chromosome->id);
        $this->assertTrue($resp);
        $this->assertNull(Chromosome::find($chromosome->id), 'Chromosome should not exist in DB');
    }
}
