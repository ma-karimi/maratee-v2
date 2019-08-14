<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\CharacterTrait;
use App\Repositories\CharacterTraitRepository;

trait MakeCharacterTraitTrait
{
    /**
     * Create fake instance of CharacterTrait and save it in database
     *
     * @param array $characterTraitFields
     * @return CharacterTrait
     */
    public function makeCharacterTrait($characterTraitFields = [])
    {
        /** @var CharacterTraitRepository $characterTraitRepo */
        $characterTraitRepo = \App::make(CharacterTraitRepository::class);
        $theme = $this->fakeCharacterTraitData($characterTraitFields);
        return $characterTraitRepo->create($theme);
    }

    /**
     * Get fake instance of CharacterTrait
     *
     * @param array $characterTraitFields
     * @return CharacterTrait
     */
    public function fakeCharacterTrait($characterTraitFields = [])
    {
        return new CharacterTrait($this->fakeCharacterTraitData($characterTraitFields));
    }

    /**
     * Get fake data of CharacterTrait
     *
     * @param array $characterTraitFields
     * @return array
     */
    public function fakeCharacterTraitData($characterTraitFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $characterTraitFields);
    }
}
