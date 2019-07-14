<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\SeedExchange;
use App\Repositories\SeedExchangeRepository;

trait MakeSeedExchangeTrait
{
    /**
     * Create fake instance of SeedExchange and save it in database
     *
     * @param array $seedExchangeFields
     * @return SeedExchange
     */
    public function makeSeedExchange($seedExchangeFields = [])
    {
        /** @var SeedExchangeRepository $seedExchangeRepo */
        $seedExchangeRepo = \App::make(SeedExchangeRepository::class);
        $theme = $this->fakeSeedExchangeData($seedExchangeFields);
        return $seedExchangeRepo->create($theme);
    }

    /**
     * Get fake instance of SeedExchange
     *
     * @param array $seedExchangeFields
     * @return SeedExchange
     */
    public function fakeSeedExchange($seedExchangeFields = [])
    {
        return new SeedExchange($this->fakeSeedExchangeData($seedExchangeFields));
    }

    /**
     * Get fake data of SeedExchange
     *
     * @param array $seedExchangeFields
     * @return array
     */
    public function fakeSeedExchangeData($seedExchangeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $seedExchangeFields);
    }
}
