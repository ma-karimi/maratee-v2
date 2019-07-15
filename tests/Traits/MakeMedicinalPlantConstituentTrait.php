<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\MedicinalPlantConstituent;
use App\Repositories\MedicinalPlantConstituentRepository;

trait MakeMedicinalPlantConstituentTrait
{
    /**
     * Create fake instance of MedicinalPlantConstituent and save it in database
     *
     * @param array $medicinalPlantConstituentFields
     * @return MedicinalPlantConstituent
     */
    public function makeMedicinalPlantConstituent($medicinalPlantConstituentFields = [])
    {
        /** @var MedicinalPlantConstituentRepository $medicinalPlantConstituentRepo */
        $medicinalPlantConstituentRepo = \App::make(MedicinalPlantConstituentRepository::class);
        $theme = $this->fakeMedicinalPlantConstituentData($medicinalPlantConstituentFields);
        return $medicinalPlantConstituentRepo->create($theme);
    }

    /**
     * Get fake instance of MedicinalPlantConstituent
     *
     * @param array $medicinalPlantConstituentFields
     * @return MedicinalPlantConstituent
     */
    public function fakeMedicinalPlantConstituent($medicinalPlantConstituentFields = [])
    {
        return new MedicinalPlantConstituent($this->fakeMedicinalPlantConstituentData($medicinalPlantConstituentFields));
    }

    /**
     * Get fake data of MedicinalPlantConstituent
     *
     * @param array $medicinalPlantConstituentFields
     * @return array
     */
    public function fakeMedicinalPlantConstituentData($medicinalPlantConstituentFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $medicinalPlantConstituentFields);
    }
}
