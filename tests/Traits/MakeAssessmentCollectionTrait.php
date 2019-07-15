<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\AssessmentCollection;
use App\Repositories\AssessmentCollectionRepository;

trait MakeAssessmentCollectionTrait
{
    /**
     * Create fake instance of AssessmentCollection and save it in database
     *
     * @param array $assessmentCollectionFields
     * @return AssessmentCollection
     */
    public function makeAssessmentCollection($assessmentCollectionFields = [])
    {
        /** @var AssessmentCollectionRepository $assessmentCollectionRepo */
        $assessmentCollectionRepo = \App::make(AssessmentCollectionRepository::class);
        $theme = $this->fakeAssessmentCollectionData($assessmentCollectionFields);
        return $assessmentCollectionRepo->create($theme);
    }

    /**
     * Get fake instance of AssessmentCollection
     *
     * @param array $assessmentCollectionFields
     * @return AssessmentCollection
     */
    public function fakeAssessmentCollection($assessmentCollectionFields = [])
    {
        return new AssessmentCollection($this->fakeAssessmentCollectionData($assessmentCollectionFields));
    }

    /**
     * Get fake data of AssessmentCollection
     *
     * @param array $assessmentCollectionFields
     * @return array
     */
    public function fakeAssessmentCollectionData($assessmentCollectionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $assessmentCollectionFields);
    }
}
