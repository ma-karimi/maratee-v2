<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Chemical;
use App\Repositories\ChemicalRepository;

trait MakeChemicalTrait
{
    /**
     * Create fake instance of Chemical and save it in database
     *
     * @param array $chemicalFields
     * @return Chemical
     */
    public function makeChemical($chemicalFields = [])
    {
        /** @var ChemicalRepository $chemicalRepo */
        $chemicalRepo = \App::make(ChemicalRepository::class);
        $theme = $this->fakeChemicalData($chemicalFields);
        return $chemicalRepo->create($theme);
    }

    /**
     * Get fake instance of Chemical
     *
     * @param array $chemicalFields
     * @return Chemical
     */
    public function fakeChemical($chemicalFields = [])
    {
        return new Chemical($this->fakeChemicalData($chemicalFields));
    }

    /**
     * Get fake data of Chemical
     *
     * @param array $chemicalFields
     * @return array
     */
    public function fakeChemicalData($chemicalFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $chemicalFields);
    }
}
