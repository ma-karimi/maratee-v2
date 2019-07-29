<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\SeedHub;
use App\Repositories\SeedHubRepository;

trait MakeSeedHubTrait
{
    /**
     * Create fake instance of SeedHub and save it in database
     *
     * @param array $seedHubFields
     * @return SeedHub
     */
    public function makeSeedHub($seedHubFields = [])
    {
        /** @var SeedHubRepository $seedHubRepo */
        $seedHubRepo = \App::make(SeedHubRepository::class);
        $theme = $this->fakeSeedHubData($seedHubFields);
        return $seedHubRepo->create($theme);
    }

    /**
     * Get fake instance of SeedHub
     *
     * @param array $seedHubFields
     * @return SeedHub
     */
    public function fakeSeedHub($seedHubFields = [])
    {
        return new SeedHub($this->fakeSeedHubData($seedHubFields));
    }

    /**
     * Get fake data of SeedHub
     *
     * @param array $seedHubFields
     * @return array
     */
    public function fakeSeedHubData($seedHubFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $seedHubFields);
    }
}
