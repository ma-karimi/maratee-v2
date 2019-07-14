<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\PlantingAction;
use App\Repositories\PlantingActionRepository;

trait MakePlantingActionTrait
{
    /**
     * Create fake instance of PlantingAction and save it in database
     *
     * @param array $plantingActionFields
     * @return PlantingAction
     */
    public function makePlantingAction($plantingActionFields = [])
    {
        /** @var PlantingActionRepository $plantingActionRepo */
        $plantingActionRepo = \App::make(PlantingActionRepository::class);
        $theme = $this->fakePlantingActionData($plantingActionFields);
        return $plantingActionRepo->create($theme);
    }

    /**
     * Get fake instance of PlantingAction
     *
     * @param array $plantingActionFields
     * @return PlantingAction
     */
    public function fakePlantingAction($plantingActionFields = [])
    {
        return new PlantingAction($this->fakePlantingActionData($plantingActionFields));
    }

    /**
     * Get fake data of PlantingAction
     *
     * @param array $plantingActionFields
     * @return array
     */
    public function fakePlantingActionData($plantingActionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $plantingActionFields);
    }
}
