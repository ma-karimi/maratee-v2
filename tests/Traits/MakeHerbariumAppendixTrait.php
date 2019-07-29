<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\HerbariumAppendix;
use App\Repositories\HerbariumAppendixRepository;

trait MakeHerbariumAppendixTrait
{
    /**
     * Create fake instance of HerbariumAppendix and save it in database
     *
     * @param array $herbariumAppendixFields
     * @return HerbariumAppendix
     */
    public function makeHerbariumAppendix($herbariumAppendixFields = [])
    {
        /** @var HerbariumAppendixRepository $herbariumAppendixRepo */
        $herbariumAppendixRepo = \App::make(HerbariumAppendixRepository::class);
        $theme = $this->fakeHerbariumAppendixData($herbariumAppendixFields);
        return $herbariumAppendixRepo->create($theme);
    }

    /**
     * Get fake instance of HerbariumAppendix
     *
     * @param array $herbariumAppendixFields
     * @return HerbariumAppendix
     */
    public function fakeHerbariumAppendix($herbariumAppendixFields = [])
    {
        return new HerbariumAppendix($this->fakeHerbariumAppendixData($herbariumAppendixFields));
    }

    /**
     * Get fake data of HerbariumAppendix
     *
     * @param array $herbariumAppendixFields
     * @return array
     */
    public function fakeHerbariumAppendixData($herbariumAppendixFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $herbariumAppendixFields);
    }
}
