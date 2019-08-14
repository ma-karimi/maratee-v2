<?php namespace Tests\Repositories;

use App\Models\Dimension;
use App\Repositories\DimensionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeDimensionTrait;
use Tests\ApiTestTrait;

class DimensionRepositoryTest extends TestCase
{
    use MakeDimensionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DimensionRepository
     */
    protected $dimensionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->dimensionRepo = \App::make(DimensionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_dimension()
    {
        $dimension = $this->fakeDimensionData();
        $createdDimension = $this->dimensionRepo->create($dimension);
        $createdDimension = $createdDimension->toArray();
        $this->assertArrayHasKey('id', $createdDimension);
        $this->assertNotNull($createdDimension['id'], 'Created Dimension must have id specified');
        $this->assertNotNull(Dimension::find($createdDimension['id']), 'Dimension with given id must be in DB');
        $this->assertModelData($dimension, $createdDimension);
    }

    /**
     * @test read
     */
    public function test_read_dimension()
    {
        $dimension = $this->makeDimension();
        $dbDimension = $this->dimensionRepo->find($dimension->id);
        $dbDimension = $dbDimension->toArray();
        $this->assertModelData($dimension->toArray(), $dbDimension);
    }

    /**
     * @test update
     */
    public function test_update_dimension()
    {
        $dimension = $this->makeDimension();
        $fakeDimension = $this->fakeDimensionData();
        $updatedDimension = $this->dimensionRepo->update($fakeDimension, $dimension->id);
        $this->assertModelData($fakeDimension, $updatedDimension->toArray());
        $dbDimension = $this->dimensionRepo->find($dimension->id);
        $this->assertModelData($fakeDimension, $dbDimension->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_dimension()
    {
        $dimension = $this->makeDimension();
        $resp = $this->dimensionRepo->delete($dimension->id);
        $this->assertTrue($resp);
        $this->assertNull(Dimension::find($dimension->id), 'Dimension should not exist in DB');
    }
}
