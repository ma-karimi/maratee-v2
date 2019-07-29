<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Collection;
use App\Repositories\CollectionRepository;

trait MakeCollectionTrait
{
    /**
     * Create fake instance of Collection and save it in database
     *
     * @param array $collectionFields
     * @return Collection
     */
    public function makeCollection($collectionFields = [])
    {
        /** @var CollectionRepository $collectionRepo */
        $collectionRepo = \App::make(CollectionRepository::class);
        $theme = $this->fakeCollectionData($collectionFields);
        return $collectionRepo->create($theme);
    }

    /**
     * Get fake instance of Collection
     *
     * @param array $collectionFields
     * @return Collection
     */
    public function fakeCollection($collectionFields = [])
    {
        return new Collection($this->fakeCollectionData($collectionFields));
    }

    /**
     * Get fake data of Collection
     *
     * @param array $collectionFields
     * @return array
     */
    public function fakeCollectionData($collectionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $collectionFields);
    }
}
