<?php namespace Tests\Repositories;

use App\Models\LifeForm;
use App\Repositories\LifeFormRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class LifeFormRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var LifeFormRepository
     */
    protected $lifeFormRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->lifeFormRepo = \App::make(LifeFormRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_life_form()
    {
        $lifeForm = factory(LifeForm::class)->make()->toArray();

        $createdLifeForm = $this->lifeFormRepo->create($lifeForm);

        $createdLifeForm = $createdLifeForm->toArray();
        $this->assertArrayHasKey('id', $createdLifeForm);
        $this->assertNotNull($createdLifeForm['id'], 'Created LifeForm must have id specified');
        $this->assertNotNull(LifeForm::find($createdLifeForm['id']), 'LifeForm with given id must be in DB');
        $this->assertModelData($lifeForm, $createdLifeForm);
    }

    /**
     * @test read
     */
    public function test_read_life_form()
    {
        $lifeForm = factory(LifeForm::class)->create();

        $dbLifeForm = $this->lifeFormRepo->find($lifeForm->id);

        $dbLifeForm = $dbLifeForm->toArray();
        $this->assertModelData($lifeForm->toArray(), $dbLifeForm);
    }

    /**
     * @test update
     */
    public function test_update_life_form()
    {
        $lifeForm = factory(LifeForm::class)->create();
        $fakeLifeForm = factory(LifeForm::class)->make()->toArray();

        $updatedLifeForm = $this->lifeFormRepo->update($fakeLifeForm, $lifeForm->id);

        $this->assertModelData($fakeLifeForm, $updatedLifeForm->toArray());
        $dbLifeForm = $this->lifeFormRepo->find($lifeForm->id);
        $this->assertModelData($fakeLifeForm, $dbLifeForm->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_life_form()
    {
        $lifeForm = factory(LifeForm::class)->create();

        $resp = $this->lifeFormRepo->delete($lifeForm->id);

        $this->assertTrue($resp);
        $this->assertNull(LifeForm::find($lifeForm->id), 'LifeForm should not exist in DB');
    }
}
