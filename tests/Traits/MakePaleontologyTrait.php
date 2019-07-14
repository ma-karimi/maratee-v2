<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Paleontology;
use App\Repositories\PaleontologyRepository;

trait MakePaleontologyTrait
{
    /**
     * Create fake instance of Paleontology and save it in database
     *
     * @param array $paleontologyFields
     * @return Paleontology
     */
    public function makePaleontology($paleontologyFields = [])
    {
        /** @var PaleontologyRepository $paleontologyRepo */
        $paleontologyRepo = \App::make(PaleontologyRepository::class);
        $theme = $this->fakePaleontologyData($paleontologyFields);
        return $paleontologyRepo->create($theme);
    }

    /**
     * Get fake instance of Paleontology
     *
     * @param array $paleontologyFields
     * @return Paleontology
     */
    public function fakePaleontology($paleontologyFields = [])
    {
        return new Paleontology($this->fakePaleontologyData($paleontologyFields));
    }

    /**
     * Get fake data of Paleontology
     *
     * @param array $paleontologyFields
     * @return array
     */
    public function fakePaleontologyData($paleontologyFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $paleontologyFields);
    }
}
