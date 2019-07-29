<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Botanical;
use App\Repositories\BotanicalRepository;

trait MakeBotanicalTrait
{
    /**
     * Create fake instance of Botanical and save it in database
     *
     * @param array $botanicalFields
     * @return Botanical
     */
    public function makeBotanical($botanicalFields = [])
    {
        /** @var BotanicalRepository $botanicalRepo */
        $botanicalRepo = \App::make(BotanicalRepository::class);
        $theme = $this->fakeBotanicalData($botanicalFields);
        return $botanicalRepo->create($theme);
    }

    /**
     * Get fake instance of Botanical
     *
     * @param array $botanicalFields
     * @return Botanical
     */
    public function fakeBotanical($botanicalFields = [])
    {
        return new Botanical($this->fakeBotanicalData($botanicalFields));
    }

    /**
     * Get fake data of Botanical
     *
     * @param array $botanicalFields
     * @return array
     */
    public function fakeBotanicalData($botanicalFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $botanicalFields);
    }
}
