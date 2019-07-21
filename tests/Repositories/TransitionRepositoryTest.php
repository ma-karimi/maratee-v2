<?php namespace Tests\Repositories;

use App\Models\Transition;
use App\Repositories\TransitionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeTransitionTrait;
use Tests\ApiTestTrait;

class TransitionRepositoryTest extends TestCase
{
    use MakeTransitionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TransitionRepository
     */
    protected $transitionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->transitionRepo = \App::make(TransitionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_transition()
    {
        $transition = $this->fakeTransitionData();
        $createdTransition = $this->transitionRepo->create($transition);
        $createdTransition = $createdTransition->toArray();
        $this->assertArrayHasKey('id', $createdTransition);
        $this->assertNotNull($createdTransition['id'], 'Created Transition must have id specified');
        $this->assertNotNull(Transition::find($createdTransition['id']), 'Transition with given id must be in DB');
        $this->assertModelData($transition, $createdTransition);
    }

    /**
     * @test read
     */
    public function test_read_transition()
    {
        $transition = $this->makeTransition();
        $dbTransition = $this->transitionRepo->find($transition->id);
        $dbTransition = $dbTransition->toArray();
        $this->assertModelData($transition->toArray(), $dbTransition);
    }

    /**
     * @test update
     */
    public function test_update_transition()
    {
        $transition = $this->makeTransition();
        $fakeTransition = $this->fakeTransitionData();
        $updatedTransition = $this->transitionRepo->update($fakeTransition, $transition->id);
        $this->assertModelData($fakeTransition, $updatedTransition->toArray());
        $dbTransition = $this->transitionRepo->find($transition->id);
        $this->assertModelData($fakeTransition, $dbTransition->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_transition()
    {
        $transition = $this->makeTransition();
        $resp = $this->transitionRepo->delete($transition->id);
        $this->assertTrue($resp);
        $this->assertNull(Transition::find($transition->id), 'Transition should not exist in DB');
    }
}
