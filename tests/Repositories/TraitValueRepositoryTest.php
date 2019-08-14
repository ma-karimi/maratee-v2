<?php namespace Tests\Repositories;

use App\Models\TraitValue;
use App\Repositories\TraitValueRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeTraitValueTrait;
use Tests\ApiTestTrait;

class TraitValueRepositoryTest extends TestCase
{
    use MakeTraitValueTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TraitValueRepository
     */
    protected $traitValueRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->traitValueRepo = \App::make(TraitValueRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_trait_value()
    {
        $traitValue = $this->fakeTraitValueData();
        $createdTraitValue = $this->traitValueRepo->create($traitValue);
        $createdTraitValue = $createdTraitValue->toArray();
        $this->assertArrayHasKey('id', $createdTraitValue);
        $this->assertNotNull($createdTraitValue['id'], 'Created TraitValue must have id specified');
        $this->assertNotNull(TraitValue::find($createdTraitValue['id']), 'TraitValue with given id must be in DB');
        $this->assertModelData($traitValue, $createdTraitValue);
    }

    /**
     * @test read
     */
    public function test_read_trait_value()
    {
        $traitValue = $this->makeTraitValue();
        $dbTraitValue = $this->traitValueRepo->find($traitValue->id);
        $dbTraitValue = $dbTraitValue->toArray();
        $this->assertModelData($traitValue->toArray(), $dbTraitValue);
    }

    /**
     * @test update
     */
    public function test_update_trait_value()
    {
        $traitValue = $this->makeTraitValue();
        $fakeTraitValue = $this->fakeTraitValueData();
        $updatedTraitValue = $this->traitValueRepo->update($fakeTraitValue, $traitValue->id);
        $this->assertModelData($fakeTraitValue, $updatedTraitValue->toArray());
        $dbTraitValue = $this->traitValueRepo->find($traitValue->id);
        $this->assertModelData($fakeTraitValue, $dbTraitValue->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_trait_value()
    {
        $traitValue = $this->makeTraitValue();
        $resp = $this->traitValueRepo->delete($traitValue->id);
        $this->assertTrue($resp);
        $this->assertNull(TraitValue::find($traitValue->id), 'TraitValue should not exist in DB');
    }
}
