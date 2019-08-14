<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\BioMolecular;
use App\Repositories\BioMolecularRepository;

trait MakeBioMolecularTrait
{
    /**
     * Create fake instance of BioMolecular and save it in database
     *
     * @param array $bioMolecularFields
     * @return BioMolecular
     */
    public function makeBioMolecular($bioMolecularFields = [])
    {
        /** @var BioMolecularRepository $bioMolecularRepo */
        $bioMolecularRepo = \App::make(BioMolecularRepository::class);
        $theme = $this->fakeBioMolecularData($bioMolecularFields);
        return $bioMolecularRepo->create($theme);
    }

    /**
     * Get fake instance of BioMolecular
     *
     * @param array $bioMolecularFields
     * @return BioMolecular
     */
    public function fakeBioMolecular($bioMolecularFields = [])
    {
        return new BioMolecular($this->fakeBioMolecularData($bioMolecularFields));
    }

    /**
     * Get fake data of BioMolecular
     *
     * @param array $bioMolecularFields
     * @return array
     */
    public function fakeBioMolecularData($bioMolecularFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $bioMolecularFields);
    }
}
