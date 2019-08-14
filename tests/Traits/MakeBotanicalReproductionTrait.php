<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\BotanicalPropagation;
use App\Repositories\BotanicalPropagationRepository;

trait MakeBotanicalPropagationTrait
{
    /**
     * Create fake instance of BotanicalPropagation and save it in database
     *
     * @param array $botanicalPropagationFields
     * @return BotanicalPropagation
     */
    public function makeBotanicalPropagation($botanicalPropagationFields = [])
    {
        /** @var BotanicalPropagationRepository $botanicalPropagationRepo */
        $botanicalPropagationRepo = \App::make(BotanicalPropagationRepository::class);
        $theme = $this->fakeBotanicalPropagationData($botanicalPropagationFields);
        return $botanicalPropagationRepo->create($theme);
    }

    /**
     * Get fake instance of BotanicalPropagation
     *
     * @param array $botanicalPropagationFields
     * @return BotanicalPropagation
     */
    public function fakeBotanicalPropagation($botanicalPropagationFields = [])
    {
        return new BotanicalPropagation($this->fakeBotanicalPropagationData($botanicalPropagationFields));
    }

    /**
     * Get fake data of BotanicalPropagation
     *
     * @param array $botanicalPropagationFields
     * @return array
     */
    public function fakeBotanicalPropagationData($botanicalPropagationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $botanicalPropagationFields);
    }
}
