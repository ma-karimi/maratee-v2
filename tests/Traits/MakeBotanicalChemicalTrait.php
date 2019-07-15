<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\BotanicalChemical;
use App\Repositories\BotanicalChemicalRepository;

trait MakeBotanicalChemicalTrait
{
    /**
     * Create fake instance of BotanicalChemical and save it in database
     *
     * @param array $botanicalChemicalFields
     * @return BotanicalChemical
     */
    public function makeBotanicalChemical($botanicalChemicalFields = [])
    {
        /** @var BotanicalChemicalRepository $botanicalChemicalRepo */
        $botanicalChemicalRepo = \App::make(BotanicalChemicalRepository::class);
        $theme = $this->fakeBotanicalChemicalData($botanicalChemicalFields);
        return $botanicalChemicalRepo->create($theme);
    }

    /**
     * Get fake instance of BotanicalChemical
     *
     * @param array $botanicalChemicalFields
     * @return BotanicalChemical
     */
    public function fakeBotanicalChemical($botanicalChemicalFields = [])
    {
        return new BotanicalChemical($this->fakeBotanicalChemicalData($botanicalChemicalFields));
    }

    /**
     * Get fake data of BotanicalChemical
     *
     * @param array $botanicalChemicalFields
     * @return array
     */
    public function fakeBotanicalChemicalData($botanicalChemicalFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $botanicalChemicalFields);
    }
}
