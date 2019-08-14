<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Block;
use App\Repositories\BlockRepository;

trait MakeBlockTrait
{
    /**
     * Create fake instance of Block and save it in database
     *
     * @param array $blockFields
     * @return Block
     */
    public function makeBlock($blockFields = [])
    {
        /** @var BlockRepository $blockRepo */
        $blockRepo = \App::make(BlockRepository::class);
        $theme = $this->fakeBlockData($blockFields);
        return $blockRepo->create($theme);
    }

    /**
     * Get fake instance of Block
     *
     * @param array $blockFields
     * @return Block
     */
    public function fakeBlock($blockFields = [])
    {
        return new Block($this->fakeBlockData($blockFields));
    }

    /**
     * Get fake data of Block
     *
     * @param array $blockFields
     * @return array
     */
    public function fakeBlockData($blockFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $blockFields);
    }
}
