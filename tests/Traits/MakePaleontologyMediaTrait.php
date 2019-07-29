<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\PaleontologyMedia;
use App\Repositories\PaleontologyMediaRepository;

trait MakePaleontologyMediaTrait
{
    /**
     * Create fake instance of PaleontologyMedia and save it in database
     *
     * @param array $paleontologyMediaFields
     * @return PaleontologyMedia
     */
    public function makePaleontologyMedia($paleontologyMediaFields = [])
    {
        /** @var PaleontologyMediaRepository $paleontologyMediaRepo */
        $paleontologyMediaRepo = \App::make(PaleontologyMediaRepository::class);
        $theme = $this->fakePaleontologyMediaData($paleontologyMediaFields);
        return $paleontologyMediaRepo->create($theme);
    }

    /**
     * Get fake instance of PaleontologyMedia
     *
     * @param array $paleontologyMediaFields
     * @return PaleontologyMedia
     */
    public function fakePaleontologyMedia($paleontologyMediaFields = [])
    {
        return new PaleontologyMedia($this->fakePaleontologyMediaData($paleontologyMediaFields));
    }

    /**
     * Get fake data of PaleontologyMedia
     *
     * @param array $paleontologyMediaFields
     * @return array
     */
    public function fakePaleontologyMediaData($paleontologyMediaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $paleontologyMediaFields);
    }
}
