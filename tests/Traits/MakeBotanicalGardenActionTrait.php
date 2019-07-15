<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\BotanicalGardenAction;
use App\Repositories\BotanicalGardenActionRepository;

trait MakeBotanicalGardenActionTrait
{
    /**
     * Create fake instance of BotanicalGardenAction and save it in database
     *
     * @param array $botanicalGardenActionFields
     * @return BotanicalGardenAction
     */
    public function makeBotanicalGardenAction($botanicalGardenActionFields = [])
    {
        /** @var BotanicalGardenActionRepository $botanicalGardenActionRepo */
        $botanicalGardenActionRepo = \App::make(BotanicalGardenActionRepository::class);
        $theme = $this->fakeBotanicalGardenActionData($botanicalGardenActionFields);
        return $botanicalGardenActionRepo->create($theme);
    }

    /**
     * Get fake instance of BotanicalGardenAction
     *
     * @param array $botanicalGardenActionFields
     * @return BotanicalGardenAction
     */
    public function fakeBotanicalGardenAction($botanicalGardenActionFields = [])
    {
        return new BotanicalGardenAction($this->fakeBotanicalGardenActionData($botanicalGardenActionFields));
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
