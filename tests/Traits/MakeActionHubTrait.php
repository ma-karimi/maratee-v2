<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\ActionHub;
use App\Repositories\ActionHubRepository;

trait MakeActionHubTrait
{
    /**
     * Create fake instance of ActionHub and save it in database
     *
     * @param array $actionHubFields
     * @return ActionHub
     */
    public function makeActionHub($actionHubFields = [])
    {
        /** @var ActionHubRepository $actionHubRepo */
        $actionHubRepo = \App::make(ActionHubRepository::class);
        $theme = $this->fakeActionHubData($actionHubFields);
        return $actionHubRepo->create($theme);
    }

    /**
     * Get fake instance of ActionHub
     *
     * @param array $actionHubFields
     * @return ActionHub
     */
    public function fakeActionHub($actionHubFields = [])
    {
        return new ActionHub($this->fakeActionHubData($actionHubFields));
    }

    /**
     * Get fake data of ActionHub
     *
     * @param array $actionHubFields
     * @return array
     */
    public function fakeActionHubData($actionHubFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $actionHubFields);
    }
}
