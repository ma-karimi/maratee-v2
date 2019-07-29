<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Group;
use App\Repositories\GroupRepository;

trait MakeGroupTrait
{
    /**
     * Create fake instance of Group and save it in database
     *
     * @param array $groupFields
     * @return Group
     */
    public function makeGroup($groupFields = [])
    {
        /** @var GroupRepository $groupRepo */
        $groupRepo = \App::make(GroupRepository::class);
        $theme = $this->fakeGroupData($groupFields);
        return $groupRepo->create($theme);
    }

    /**
     * Get fake instance of Group
     *
     * @param array $groupFields
     * @return Group
     */
    public function fakeGroup($groupFields = [])
    {
        return new Group($this->fakeGroupData($groupFields));
    }

    /**
     * Get fake data of Group
     *
     * @param array $groupFields
     * @return array
     */
    public function fakeGroupData($groupFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $groupFields);
    }
}
