<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Repeat;
use App\Repositories\RepeatRepository;

trait MakeRepeatTrait
{
    /**
     * Create fake instance of Repeat and save it in database
     *
     * @param array $repeatFields
     * @return Repeat
     */
    public function makeRepeat($repeatFields = [])
    {
        /** @var RepeatRepository $repeatRepo */
        $repeatRepo = \App::make(RepeatRepository::class);
        $theme = $this->fakeRepeatData($repeatFields);
        return $repeatRepo->create($theme);
    }

    /**
     * Get fake instance of Repeat
     *
     * @param array $repeatFields
     * @return Repeat
     */
    public function fakeRepeat($repeatFields = [])
    {
        return new Repeat($this->fakeRepeatData($repeatFields));
    }

    /**
     * Get fake data of Repeat
     *
     * @param array $repeatFields
     * @return array
     */
    public function fakeRepeatData($repeatFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $repeatFields);
    }
}
