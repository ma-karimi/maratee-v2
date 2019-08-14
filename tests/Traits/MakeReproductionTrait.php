<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Propagation;
use App\Repositories\PropagationRepository;

trait MakePropagationTrait
{
    /**
     * Create fake instance of Propagation and save it in database
     *
     * @param array $propagationFields
     * @return Propagation
     */
    public function makePropagation($propagationFields = [])
    {
        /** @var PropagationRepository $propagationRepo */
        $propagationRepo = \App::make(PropagationRepository::class);
        $theme = $this->fakePropagationData($propagationFields);
        return $propagationRepo->create($theme);
    }

    /**
     * Get fake instance of Propagation
     *
     * @param array $propagationFields
     * @return Propagation
     */
    public function fakePropagation($propagationFields = [])
    {
        return new Propagation($this->fakePropagationData($propagationFields));
    }

    /**
     * Get fake data of Propagation
     *
     * @param array $propagationFields
     * @return array
     */
    public function fakePropagationData($propagationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $propagationFields);
    }
}
