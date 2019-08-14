<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\BlockTrait;
use App\Repositories\BlockTraitRepository;

trait MakeBlockTraitTrait
{
    /**
     * Create fake instance of BlockTrait and save it in database
     *
     * @param array $blockTraitFields
     * @return BlockTrait
     */
    public function makeBlockTrait($blockTraitFields = [])
    {
        /** @var BlockTraitRepository $blockTraitRepo */
        $blockTraitRepo = \App::make(BlockTraitRepository::class);
        $theme = $this->fakeBlockTraitData($blockTraitFields);
        return $blockTraitRepo->create($theme);
    }

    /**
     * Get fake instance of BlockTrait
     *
     * @param array $blockTraitFields
     * @return BlockTrait
     */
    public function fakeBlockTrait($blockTraitFields = [])
    {
        return new BlockTrait($this->fakeBlockTraitData($blockTraitFields));
    }

    /**
     * Get fake data of BlockTrait
     *
     * @param array $blockTraitFields
     * @return array
     */
    public function fakeBlockTraitData($blockTraitFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $blockTraitFields);
    }
}
