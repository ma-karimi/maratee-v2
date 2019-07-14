<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\SeedMolecular;
use App\Repositories\SeedMolecularRepository;

trait MakeSeedMolecularTrait
{
    /**
     * Create fake instance of SeedMolecular and save it in database
     *
     * @param array $seedMolecularFields
     * @return SeedMolecular
     */
    public function makeSeedMolecular($seedMolecularFields = [])
    {
        /** @var SeedMolecularRepository $seedMolecularRepo */
        $seedMolecularRepo = \App::make(SeedMolecularRepository::class);
        $theme = $this->fakeSeedMolecularData($seedMolecularFields);
        return $seedMolecularRepo->create($theme);
    }

    /**
     * Get fake instance of SeedMolecular
     *
     * @param array $seedMolecularFields
     * @return SeedMolecular
     */
    public function fakeSeedMolecular($seedMolecularFields = [])
    {
        return new SeedMolecular($this->fakeSeedMolecularData($seedMolecularFields));
    }

    /**
     * Get fake data of SeedMolecular
     *
     * @param array $seedMolecularFields
     * @return array
     */
    public function fakeSeedMolecularData($seedMolecularFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $seedMolecularFields);
    }
}
