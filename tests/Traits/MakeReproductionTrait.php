<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Reproduction;
use App\Repositories\ReproductionRepository;

trait MakeReproductionTrait
{
    /**
     * Create fake instance of Reproduction and save it in database
     *
     * @param array $reproductionFields
     * @return Reproduction
     */
    public function makeReproduction($reproductionFields = [])
    {
        /** @var ReproductionRepository $reproductionRepo */
        $reproductionRepo = \App::make(ReproductionRepository::class);
        $theme = $this->fakeReproductionData($reproductionFields);
        return $reproductionRepo->create($theme);
    }

    /**
     * Get fake instance of Reproduction
     *
     * @param array $reproductionFields
     * @return Reproduction
     */
    public function fakeReproduction($reproductionFields = [])
    {
        return new Reproduction($this->fakeReproductionData($reproductionFields));
    }

    /**
     * Get fake data of Reproduction
     *
     * @param array $reproductionFields
     * @return array
     */
    public function fakeReproductionData($reproductionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $reproductionFields);
    }
}
