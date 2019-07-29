<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Transition;
use App\Repositories\TransitionRepository;

trait MakeTransitionTrait
{
    /**
     * Create fake instance of Transition and save it in database
     *
     * @param array $transitionFields
     * @return Transition
     */
    public function makeTransition($transitionFields = [])
    {
        /** @var TransitionRepository $transitionRepo */
        $transitionRepo = \App::make(TransitionRepository::class);
        $theme = $this->fakeTransitionData($transitionFields);
        return $transitionRepo->create($theme);
    }

    /**
     * Get fake instance of Transition
     *
     * @param array $transitionFields
     * @return Transition
     */
    public function fakeTransition($transitionFields = [])
    {
        return new Transition($this->fakeTransitionData($transitionFields));
    }

    /**
     * Get fake data of Transition
     *
     * @param array $transitionFields
     * @return array
     */
    public function fakeTransitionData($transitionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $transitionFields);
    }
}
