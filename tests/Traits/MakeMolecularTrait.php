<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Molecular;
use App\Repositories\MolecularRepository;

trait MakeMolecularTrait
{
    /**
     * Create fake instance of Molecular and save it in database
     *
     * @param array $molecularFields
     * @return Molecular
     */
    public function makeMolecular($molecularFields = [])
    {
        /** @var MolecularRepository $molecularRepo */
        $molecularRepo = \App::make(MolecularRepository::class);
        $theme = $this->fakeMolecularData($molecularFields);
        return $molecularRepo->create($theme);
    }

    /**
     * Get fake instance of Molecular
     *
     * @param array $molecularFields
     * @return Molecular
     */
    public function fakeMolecular($molecularFields = [])
    {
        return new Molecular($this->fakeMolecularData($molecularFields));
    }

    /**
     * Get fake data of Molecular
     *
     * @param array $molecularFields
     * @return array
     */
    public function fakeMolecularData($molecularFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $molecularFields);
    }
}
