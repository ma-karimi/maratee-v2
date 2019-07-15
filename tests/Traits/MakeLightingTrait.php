<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Lighting;
use App\Repositories\LightingRepository;

trait MakeLightingTrait
{
    /**
     * Create fake instance of Lighting and save it in database
     *
     * @param array $lightingFields
     * @return Lighting
     */
    public function makeLighting($lightingFields = [])
    {
        /** @var LightingRepository $lightingRepo */
        $lightingRepo = \App::make(LightingRepository::class);
        $theme = $this->fakeLightingData($lightingFields);
        return $lightingRepo->create($theme);
    }

    /**
     * Get fake instance of Lighting
     *
     * @param array $lightingFields
     * @return Lighting
     */
    public function fakeLighting($lightingFields = [])
    {
        return new Lighting($this->fakeLightingData($lightingFields));
    }

    /**
     * Get fake data of Lighting
     *
     * @param array $lightingFields
     * @return array
     */
    public function fakeLightingData($lightingFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $lightingFields);
    }
}
