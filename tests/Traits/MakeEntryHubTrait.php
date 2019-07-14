<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\EntryHub;
use App\Repositories\EntryHubRepository;

trait MakeEntryHubTrait
{
    /**
     * Create fake instance of EntryHub and save it in database
     *
     * @param array $entryHubFields
     * @return EntryHub
     */
    public function makeEntryHub($entryHubFields = [])
    {
        /** @var EntryHubRepository $entryHubRepo */
        $entryHubRepo = \App::make(EntryHubRepository::class);
        $theme = $this->fakeEntryHubData($entryHubFields);
        return $entryHubRepo->create($theme);
    }

    /**
     * Get fake instance of EntryHub
     *
     * @param array $entryHubFields
     * @return EntryHub
     */
    public function fakeEntryHub($entryHubFields = [])
    {
        return new EntryHub($this->fakeEntryHubData($entryHubFields));
    }

    /**
     * Get fake data of EntryHub
     *
     * @param array $entryHubFields
     * @return array
     */
    public function fakeEntryHubData($entryHubFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $entryHubFields);
    }
}
