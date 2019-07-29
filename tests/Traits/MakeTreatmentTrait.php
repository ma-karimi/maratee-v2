<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Treatment;
use App\Repositories\TreatmentRepository;

trait MakeTreatmentTrait
{
    /**
     * Create fake instance of Treatment and save it in database
     *
     * @param array $treatmentFields
     * @return Treatment
     */
    public function makeTreatment($treatmentFields = [])
    {
        /** @var TreatmentRepository $treatmentRepo */
        $treatmentRepo = \App::make(TreatmentRepository::class);
        $theme = $this->fakeTreatmentData($treatmentFields);
        return $treatmentRepo->create($theme);
    }

    /**
     * Get fake instance of Treatment
     *
     * @param array $treatmentFields
     * @return Treatment
     */
    public function fakeTreatment($treatmentFields = [])
    {
        return new Treatment($this->fakeTreatmentData($treatmentFields));
    }

    /**
     * Get fake data of Treatment
     *
     * @param array $treatmentFields
     * @return array
     */
    public function fakeTreatmentData($treatmentFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $treatmentFields);
    }
}
