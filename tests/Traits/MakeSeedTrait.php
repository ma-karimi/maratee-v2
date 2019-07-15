<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Seed;
use App\Repositories\SeedRepository;

trait MakeSeedTrait
{
    /**
     * Create fake instance of Seed and save it in database
     *
     * @param array $seedFields
     * @return Seed
     */
    public function makeSeed($seedFields = [])
    {
        /** @var SeedRepository $seedRepo */
        $seedRepo = \App::make(SeedRepository::class);
        $theme = $this->fakeSeedData($seedFields);
        return $seedRepo->create($theme);
    }

    /**
     * Get fake instance of Seed
     *
     * @param array $seedFields
     * @return Seed
     */
    public function fakeSeed($seedFields = [])
    {
        return new Seed($this->fakeSeedData($seedFields));
    }

    /**
     * Get fake data of Seed
     *
     * @param array $seedFields
     * @return array
     */
    public function fakeSeedData($seedFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $seedFields);
    }
}
