<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Character;
use App\Repositories\CharacterRepository;

trait MakeCharacterTrait
{
    /**
     * Create fake instance of Character and save it in database
     *
     * @param array $characterFields
     * @return Character
     */
    public function makeCharacter($characterFields = [])
    {
        /** @var CharacterRepository $characterRepo */
        $characterRepo = \App::make(CharacterRepository::class);
        $theme = $this->fakeCharacterData($characterFields);
        return $characterRepo->create($theme);
    }

    /**
     * Get fake instance of Character
     *
     * @param array $characterFields
     * @return Character
     */
    public function fakeCharacter($characterFields = [])
    {
        return new Character($this->fakeCharacterData($characterFields));
    }

    /**
     * Get fake data of Character
     *
     * @param array $characterFields
     * @return array
     */
    public function fakeCharacterData($characterFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $characterFields);
    }
}
