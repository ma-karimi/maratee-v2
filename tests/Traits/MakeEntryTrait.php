<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Entry;
use App\Repositories\EntryRepository;

trait MakeEntryTrait
{
    /**
     * Create fake instance of Entry and save it in database
     *
     * @param array $entryFields
     * @return Entry
     */
    public function makeEntry($entryFields = [])
    {
        /** @var EntryRepository $entryRepo */
        $entryRepo = \App::make(EntryRepository::class);
        $theme = $this->fakeEntryData($entryFields);
        return $entryRepo->create($theme);
    }

    /**
     * Get fake instance of Entry
     *
     * @param array $entryFields
     * @return Entry
     */
    public function fakeEntry($entryFields = [])
    {
        return new Entry($this->fakeEntryData($entryFields));
    }

    /**
     * Get fake data of Entry
     *
     * @param array $entryFields
     * @return array
     */
    public function fakeEntryData($entryFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $entryFields);
    }
}
