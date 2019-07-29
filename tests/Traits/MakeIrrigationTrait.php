<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Irrigation;
use App\Repositories\IrrigationRepository;

trait MakeIrrigationTrait
{
    /**
     * Create fake instance of Irrigation and save it in database
     *
     * @param array $irrigationFields
     * @return Irrigation
     */
    public function makeIrrigation($irrigationFields = [])
    {
        /** @var IrrigationRepository $irrigationRepo */
        $irrigationRepo = \App::make(IrrigationRepository::class);
        $theme = $this->fakeIrrigationData($irrigationFields);
        return $irrigationRepo->create($theme);
    }

    /**
     * Get fake instance of Irrigation
     *
     * @param array $irrigationFields
     * @return Irrigation
     */
    public function fakeIrrigation($irrigationFields = [])
    {
        return new Irrigation($this->fakeIrrigationData($irrigationFields));
    }

    /**
     * Get fake data of Irrigation
     *
     * @param array $irrigationFields
     * @return array
     */
    public function fakeIrrigationData($irrigationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $irrigationFields);
    }
}
