<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\TraitValue;
use App\Repositories\TraitValueRepository;

trait MakeTraitValueTrait
{
    /**
     * Create fake instance of TraitValue and save it in database
     *
     * @param array $traitValueFields
     * @return TraitValue
     */
    public function makeTraitValue($traitValueFields = [])
    {
        /** @var TraitValueRepository $traitValueRepo */
        $traitValueRepo = \App::make(TraitValueRepository::class);
        $theme = $this->fakeTraitValueData($traitValueFields);
        return $traitValueRepo->create($theme);
    }

    /**
     * Get fake instance of TraitValue
     *
     * @param array $traitValueFields
     * @return TraitValue
     */
    public function fakeTraitValue($traitValueFields = [])
    {
        return new TraitValue($this->fakeTraitValueData($traitValueFields));
    }

    /**
     * Get fake data of TraitValue
     *
     * @param array $traitValueFields
     * @return array
     */
    public function fakeTraitValueData($traitValueFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $traitValueFields);
    }
}
