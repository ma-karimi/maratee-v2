<?php namespace Tests\Repositories;

use App\Models\Taxonomy;
use App\Repositories\TaxonomyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeTaxonomyTrait;
use Tests\ApiTestTrait;

class TaxonomyRepositoryTest extends TestCase
{
    use MakeTaxonomyTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TaxonomyRepository
     */
    protected $taxonomyRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->taxonomyRepo = \App::make(TaxonomyRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_taxonomy()
    {
        $taxonomy = $this->fakeTaxonomyData();
        $createdTaxonomy = $this->taxonomyRepo->create($taxonomy);
        $createdTaxonomy = $createdTaxonomy->toArray();
        $this->assertArrayHasKey('id', $createdTaxonomy);
        $this->assertNotNull($createdTaxonomy['id'], 'Created Taxonomy must have id specified');
        $this->assertNotNull(Taxonomy::find($createdTaxonomy['id']), 'Taxonomy with given id must be in DB');
        $this->assertModelData($taxonomy, $createdTaxonomy);
    }

    /**
     * @test read
     */
    public function test_read_taxonomy()
    {
        $taxonomy = $this->makeTaxonomy();
        $dbTaxonomy = $this->taxonomyRepo->find($taxonomy->id);
        $dbTaxonomy = $dbTaxonomy->toArray();
        $this->assertModelData($taxonomy->toArray(), $dbTaxonomy);
    }

    /**
     * @test update
     */
    public function test_update_taxonomy()
    {
        $taxonomy = $this->makeTaxonomy();
        $fakeTaxonomy = $this->fakeTaxonomyData();
        $updatedTaxonomy = $this->taxonomyRepo->update($fakeTaxonomy, $taxonomy->id);
        $this->assertModelData($fakeTaxonomy, $updatedTaxonomy->toArray());
        $dbTaxonomy = $this->taxonomyRepo->find($taxonomy->id);
        $this->assertModelData($fakeTaxonomy, $dbTaxonomy->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_taxonomy()
    {
        $taxonomy = $this->makeTaxonomy();
        $resp = $this->taxonomyRepo->delete($taxonomy->id);
        $this->assertTrue($resp);
        $this->assertNull(Taxonomy::find($taxonomy->id), 'Taxonomy should not exist in DB');
    }
}
