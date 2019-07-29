<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\BotanicalReproduction;
use App\Repositories\BotanicalReproductionRepository;

trait MakeBotanicalReproductionTrait
{
    /**
     * Create fake instance of BotanicalReproduction and save it in database
     *
     * @param array $botanicalReproductionFields
     * @return BotanicalReproduction
     */
    public function makeBotanicalReproduction($botanicalReproductionFields = [])
    {
        /** @var BotanicalReproductionRepository $botanicalReproductionRepo */
        $botanicalReproductionRepo = \App::make(BotanicalReproductionRepository::class);
        $theme = $this->fakeBotanicalReproductionData($botanicalReproductionFields);
        return $botanicalReproductionRepo->create($theme);
    }

    /**
     * Get fake instance of BotanicalReproduction
     *
     * @param array $botanicalReproductionFields
     * @return BotanicalReproduction
     */
    public function fakeBotanicalReproduction($botanicalReproductionFields = [])
    {
        return new BotanicalReproduction($this->fakeBotanicalReproductionData($botanicalReproductionFields));
    }

    /**
     * Get fake data of BotanicalReproduction
     *
     * @param array $botanicalReproductionFields
     * @return array
     */
    public function fakeBotanicalReproductionData($botanicalReproductionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $botanicalReproductionFields);
    }
}
