<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\PaleontologyAction;
use App\Repositories\PaleontologyActionRepository;

trait MakePaleontologyActionTrait
{
    /**
     * Create fake instance of PaleontologyAction and save it in database
     *
     * @param array $paleontologyActionFields
     * @return PaleontologyAction
     */
    public function makePaleontologyAction($paleontologyActionFields = [])
    {
        /** @var PaleontologyActionRepository $paleontologyActionRepo */
        $paleontologyActionRepo = \App::make(PaleontologyActionRepository::class);
        $theme = $this->fakePaleontologyActionData($paleontologyActionFields);
        return $paleontologyActionRepo->create($theme);
    }

    /**
     * Get fake instance of PaleontologyAction
     *
     * @param array $paleontologyActionFields
     * @return PaleontologyAction
     */
    public function fakePaleontologyAction($paleontologyActionFields = [])
    {
        return new PaleontologyAction($this->fakePaleontologyActionData($paleontologyActionFields));
    }

    /**
     * Get fake data of PaleontologyAction
     *
     * @param array $paleontologyActionFields
     * @return array
     */
    public function fakePaleontologyActionData($paleontologyActionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $paleontologyActionFields);
    }
}
