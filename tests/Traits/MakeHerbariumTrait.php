<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Herbarium;
use App\Repositories\HerbariumRepository;

trait MakeHerbariumTrait
{
    /**
     * Create fake instance of Herbarium and save it in database
     *
     * @param array $herbariumFields
     * @return Herbarium
     */
    public function makeHerbarium($herbariumFields = [])
    {
        /** @var HerbariumRepository $herbariumRepo */
        $herbariumRepo = \App::make(HerbariumRepository::class);
        $theme = $this->fakeHerbariumData($herbariumFields);
        return $herbariumRepo->create($theme);
    }

    /**
     * Get fake instance of Herbarium
     *
     * @param array $herbariumFields
     * @return Herbarium
     */
    public function fakeHerbarium($herbariumFields = [])
    {
        return new Herbarium($this->fakeHerbariumData($herbariumFields));
    }

    /**
     * Get fake data of Herbarium
     *
     * @param array $herbariumFields
     * @return array
     */
    public function fakeHerbariumData($herbariumFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $herbariumFields);
    }
}
