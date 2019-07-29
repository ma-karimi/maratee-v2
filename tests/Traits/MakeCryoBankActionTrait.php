<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\CryoBankAction;
use App\Repositories\CryoBankActionRepository;

trait MakeCryoBankActionTrait
{
    /**
     * Create fake instance of CryoBankAction and save it in database
     *
     * @param array $cryoBankActionFields
     * @return CryoBankAction
     */
    public function makeCryoBankAction($cryoBankActionFields = [])
    {
        /** @var CryoBankActionRepository $cryoBankActionRepo */
        $cryoBankActionRepo = \App::make(CryoBankActionRepository::class);
        $theme = $this->fakeCryoBankActionData($cryoBankActionFields);
        return $cryoBankActionRepo->create($theme);
    }

    /**
     * Get fake instance of CryoBankAction
     *
     * @param array $cryoBankActionFields
     * @return CryoBankAction
     */
    public function fakeCryoBankAction($cryoBankActionFields = [])
    {
        return new CryoBankAction($this->fakeCryoBankActionData($cryoBankActionFields));
    }

    /**
     * Get fake data of CryoBankAction
     *
     * @param array $cryoBankActionFields
     * @return array
     */
    public function fakeCryoBankActionData($cryoBankActionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $cryoBankActionFields);
    }
}
