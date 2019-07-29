<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\SeedChemical;
use App\Repositories\SeedChemicalRepository;

trait MakeSeedChemicalTrait
{
    /**
     * Create fake instance of SeedChemical and save it in database
     *
     * @param array $seedChemicalFields
     * @return SeedChemical
     */
    public function makeSeedChemical($seedChemicalFields = [])
    {
        /** @var SeedChemicalRepository $seedChemicalRepo */
        $seedChemicalRepo = \App::make(SeedChemicalRepository::class);
        $theme = $this->fakeSeedChemicalData($seedChemicalFields);
        return $seedChemicalRepo->create($theme);
    }

    /**
     * Get fake instance of SeedChemical
     *
     * @param array $seedChemicalFields
     * @return SeedChemical
     */
    public function fakeSeedChemical($seedChemicalFields = [])
    {
        return new SeedChemical($this->fakeSeedChemicalData($seedChemicalFields));
    }

    /**
     * Get fake data of SeedChemical
     *
     * @param array $seedChemicalFields
     * @return array
     */
    public function fakeSeedChemicalData($seedChemicalFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $seedChemicalFields);
    }
}
