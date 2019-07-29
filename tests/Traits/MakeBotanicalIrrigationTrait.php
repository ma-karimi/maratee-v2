<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\BotanicalIrrigation;
use App\Repositories\BotanicalIrrigationRepository;

trait MakeBotanicalIrrigationTrait
{
    /**
     * Create fake instance of BotanicalIrrigation and save it in database
     *
     * @param array $botanicalIrrigationFields
     * @return BotanicalIrrigation
     */
    public function makeBotanicalIrrigation($botanicalIrrigationFields = [])
    {
        /** @var BotanicalIrrigationRepository $botanicalIrrigationRepo */
        $botanicalIrrigationRepo = \App::make(BotanicalIrrigationRepository::class);
        $theme = $this->fakeBotanicalIrrigationData($botanicalIrrigationFields);
        return $botanicalIrrigationRepo->create($theme);
    }

    /**
     * Get fake instance of BotanicalIrrigation
     *
     * @param array $botanicalIrrigationFields
     * @return BotanicalIrrigation
     */
    public function fakeBotanicalIrrigation($botanicalIrrigationFields = [])
    {
        return new BotanicalIrrigation($this->fakeBotanicalIrrigationData($botanicalIrrigationFields));
    }

    /**
     * Get fake data of BotanicalIrrigation
     *
     * @param array $botanicalIrrigationFields
     * @return array
     */
    public function fakeBotanicalIrrigationData($botanicalIrrigationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $botanicalIrrigationFields);
    }
}
