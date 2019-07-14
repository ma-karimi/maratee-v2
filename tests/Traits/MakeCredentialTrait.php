<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Credential;
use App\Repositories\CredentialRepository;

trait MakeCredentialTrait
{
    /**
     * Create fake instance of Credential and save it in database
     *
     * @param array $credentialFields
     * @return Credential
     */
    public function makeCredential($credentialFields = [])
    {
        /** @var CredentialRepository $credentialRepo */
        $credentialRepo = \App::make(CredentialRepository::class);
        $theme = $this->fakeCredentialData($credentialFields);
        return $credentialRepo->create($theme);
    }

    /**
     * Get fake instance of Credential
     *
     * @param array $credentialFields
     * @return Credential
     */
    public function fakeCredential($credentialFields = [])
    {
        return new Credential($this->fakeCredentialData($credentialFields));
    }

    /**
     * Get fake data of Credential
     *
     * @param array $credentialFields
     * @return array
     */
    public function fakeCredentialData($credentialFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $credentialFields);
    }
}
