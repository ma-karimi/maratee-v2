<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Medical;
use App\Repositories\MedicalRepository;

trait MakeMedicalTrait
{
    /**
     * Create fake instance of Medical and save it in database
     *
     * @param array $medicalFields
     * @return Medical
     */
    public function makeMedical($medicalFields = [])
    {
        /** @var MedicalRepository $medicalRepo */
        $medicalRepo = \App::make(MedicalRepository::class);
        $theme = $this->fakeMedicalData($medicalFields);
        return $medicalRepo->create($theme);
    }

    /**
     * Get fake instance of Medical
     *
     * @param array $medicalFields
     * @return Medical
     */
    public function fakeMedical($medicalFields = [])
    {
        return new Medical($this->fakeMedicalData($medicalFields));
    }

    /**
     * Get fake data of Medical
     *
     * @param array $medicalFields
     * @return array
     */
    public function fakeMedicalData($medicalFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $medicalFields);
    }
}
