<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Exchange;
use App\Repositories\ExchangeRepository;

trait MakeExchangeTrait
{
    /**
     * Create fake instance of Exchange and save it in database
     *
     * @param array $exchangeFields
     * @return Exchange
     */
    public function makeExchange($exchangeFields = [])
    {
        /** @var ExchangeRepository $exchangeRepo */
        $exchangeRepo = \App::make(ExchangeRepository::class);
        $theme = $this->fakeExchangeData($exchangeFields);
        return $exchangeRepo->create($theme);
    }

    /**
     * Get fake instance of Exchange
     *
     * @param array $exchangeFields
     * @return Exchange
     */
    public function fakeExchange($exchangeFields = [])
    {
        return new Exchange($this->fakeExchangeData($exchangeFields));
    }

    /**
     * Get fake data of Exchange
     *
     * @param array $exchangeFields
     * @return array
     */
    public function fakeExchangeData($exchangeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $exchangeFields);
    }
}
