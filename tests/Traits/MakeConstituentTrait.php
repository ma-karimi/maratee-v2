<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Constituent;
use App\Repositories\ConstituentRepository;

trait MakeConstituentTrait
{
    /**
     * Create fake instance of Constituent and save it in database
     *
     * @param array $constituentFields
     * @return Constituent
     */
    public function makeConstituent($constituentFields = [])
    {
        /** @var ConstituentRepository $constituentRepo */
        $constituentRepo = \App::make(ConstituentRepository::class);
        $theme = $this->fakeConstituentData($constituentFields);
        return $constituentRepo->create($theme);
    }

    /**
     * Get fake instance of Constituent
     *
     * @param array $constituentFields
     * @return Constituent
     */
    public function fakeConstituent($constituentFields = [])
    {
        return new Constituent($this->fakeConstituentData($constituentFields));
    }

    /**
     * Get fake data of Constituent
     *
     * @param array $constituentFields
     * @return array
     */
    public function fakeConstituentData($constituentFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $constituentFields);
    }
}
