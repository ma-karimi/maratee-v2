<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Borrow;
use App\Repositories\BorrowRepository;

trait MakeBorrowTrait
{
    /**
     * Create fake instance of Borrow and save it in database
     *
     * @param array $borrowFields
     * @return Borrow
     */
    public function makeBorrow($borrowFields = [])
    {
        /** @var BorrowRepository $borrowRepo */
        $borrowRepo = \App::make(BorrowRepository::class);
        $theme = $this->fakeBorrowData($borrowFields);
        return $borrowRepo->create($theme);
    }

    /**
     * Get fake instance of Borrow
     *
     * @param array $borrowFields
     * @return Borrow
     */
    public function fakeBorrow($borrowFields = [])
    {
        return new Borrow($this->fakeBorrowData($borrowFields));
    }

    /**
     * Get fake data of Borrow
     *
     * @param array $borrowFields
     * @return array
     */
    public function fakeBorrowData($borrowFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $borrowFields);
    }
}
