<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Actor;
use App\Repositories\ActorRepository;

trait MakeAuthorTrait
{
    /**
     * Create fake instance of Author and save it in database
     *
     * @param array $authorFields
     * @return Actor
     */
    public function makeAuthor($authorFields = [])
    {
        /** @var ActorRepository $authorRepo */
        $authorRepo = \App::make(ActorRepository::class);
        $theme = $this->fakeAuthorData($authorFields);
        return $authorRepo->create($theme);
    }

    /**
     * Get fake instance of Author
     *
     * @param array $authorFields
     * @return Actor
     */
    public function fakeAuthor($authorFields = [])
    {
        return new Actor($this->fakeAuthorData($authorFields));
    }

    /**
     * Get fake data of Author
     *
     * @param array $authorFields
     * @return array
     */
    public function fakeAuthorData($authorFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $authorFields);
    }
}
