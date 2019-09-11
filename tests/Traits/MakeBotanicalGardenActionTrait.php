<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\BotanicalOperation;
use App\Repositories\BotanicalOperationRepository;

trait MakeBotanicalGardenActionTrait
{
    /**
     * Create fake instance of BotanicalGardenAction and save it in database
     *
     * @param array $botanicalGardenActionFields
     * @return BotanicalOperation
     */
    public function makeBotanicalGardenAction($botanicalGardenActionFields = [])
    {
        /** @var BotanicalOperationRepository $botanicalGardenActionRepo */
        $botanicalGardenActionRepo = \App::make(BotanicalOperationRepository::class);
        $theme = $this->fakeBotanicalGardenActionData($botanicalGardenActionFields);
        return $botanicalGardenActionRepo->create($theme);
    }

    /**
     * Get fake instance of BotanicalGardenAction
     *
     * @param array $botanicalGardenActionFields
     * @return BotanicalOperation
     */
    public function fakeBotanicalGardenAction($botanicalGardenActionFields = [])
    {
        return new BotanicalOperation($this->fakeBotanicalGardenActionData($botanicalGardenActionFields));
    }

    /**
     * Get fake data of BotanicalGardenAction
     *
     * @param array $botanicalGardenActionFields
     * @return array
     */
    public function fakeBotanicalGardenActionData($botanicalGardenActionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $botanicalGardenActionFields);
    }
}
