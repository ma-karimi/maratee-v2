<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\CryoBank;
use App\Repositories\CryoBankRepository;

trait MakeCryoBankTrait
{
    /**
     * Create fake instance of CryoBank and save it in database
     *
     * @param array $cryoBankFields
     * @return CryoBank
     */
    public function makeCryoBank($cryoBankFields = [])
    {
        /** @var CryoBankRepository $cryoBankRepo */
        $cryoBankRepo = \App::make(CryoBankRepository::class);
        $theme = $this->fakeCryoBankData($cryoBankFields);
        return $cryoBankRepo->create($theme);
    }

    /**
     * Get fake instance of CryoBank
     *
     * @param array $cryoBankFields
     * @return CryoBank
     */
    public function fakeCryoBank($cryoBankFields = [])
    {
        return new CryoBank($this->fakeCryoBankData($cryoBankFields));
    }

    /**
     * Get fake data of CryoBank
     *
     * @param array $cryoBankFields
     * @return array
     */
    public function fakeCryoBankData($cryoBankFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $cryoBankFields);
    }
}
