<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Citation;
use App\Repositories\CitationRepository;

trait MakePaleontologyCitationTrait
{
    /**
     * Create fake instance of PaleontologyCitation and save it in database
     *
     * @param array $paleontologyCitationFields
     * @return Citation
     */
    public function makePaleontologyCitation($paleontologyCitationFields = [])
    {
        /** @var CitationRepository $paleontologyCitationRepo */
        $paleontologyCitationRepo = \App::make(CitationRepository::class);
        $theme = $this->fakePaleontologyCitationData($paleontologyCitationFields);
        return $paleontologyCitationRepo->create($theme);
    }

    /**
     * Get fake instance of PaleontologyCitation
     *
     * @param array $paleontologyCitationFields
     * @return Citation
     */
    public function fakePaleontologyCitation($paleontologyCitationFields = [])
    {
        return new Citation($this->fakePaleontologyCitationData($paleontologyCitationFields));
    }

    /**
     * Get fake data of PaleontologyCitation
     *
     * @param array $paleontologyCitationFields
     * @return array
     */
    public function fakePaleontologyCitationData($paleontologyCitationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $paleontologyCitationFields);
    }
}
