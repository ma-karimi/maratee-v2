<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Protection;
use App\Repositories\ProtectionRepository;

trait MakeProtectionTrait
{
    /**
     * Create fake instance of Protection and save it in database
     *
     * @param array $protectionFields
     * @return Protection
     */
    public function makeProtection($protectionFields = [])
    {
        /** @var ProtectionRepository $protectionRepo */
        $protectionRepo = \App::make(ProtectionRepository::class);
        $theme = $this->fakeProtectionData($protectionFields);
        return $protectionRepo->create($theme);
    }

    /**
     * Get fake instance of Protection
     *
     * @param array $protectionFields
     * @return Protection
     */
    public function fakeProtection($protectionFields = [])
    {
        return new Protection($this->fakeProtectionData($protectionFields));
    }

    /**
     * Get fake data of Protection
     *
     * @param array $protectionFields
     * @return array
     */
    public function fakeProtectionData($protectionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $protectionFields);
    }
}
