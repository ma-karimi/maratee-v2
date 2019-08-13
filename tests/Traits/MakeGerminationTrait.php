<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Germination;
use App\Repositories\GerminationRepository;

trait MakeGerminationTrait
{
    /**
     * Create fake instance of Germination and save it in database
     *
     * @param array $germinationFields
     * @return Germination
     */
    public function makeGermination($germinationFields = [])
    {
        /** @var GerminationRepository $germinationRepo */
        $germinationRepo = \App::make(GerminationRepository::class);
        $theme = $this->fakeGerminationData($germinationFields);
        return $germinationRepo->create($theme);
    }

    /**
     * Get fake instance of Germination
     *
     * @param array $germinationFields
     * @return Germination
     */
    public function fakeGermination($germinationFields = [])
    {
        return new Germination($this->fakeGerminationData($germinationFields));
    }

    /**
     * Get fake data of Germination
     *
     * @param array $germinationFields
     * @return array
     */
    public function fakeGerminationData($germinationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $germinationFields);
    }
}
