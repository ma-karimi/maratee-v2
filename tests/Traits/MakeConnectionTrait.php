<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Connection;
use App\Repositories\ConnectionRepository;

trait MakeConnectionTrait
{
    /**
     * Create fake instance of Connection and save it in database
     *
     * @param array $connectionFields
     * @return Connection
     */
    public function makeConnection($connectionFields = [])
    {
        /** @var ConnectionRepository $connectionRepo */
        $connectionRepo = \App::make(ConnectionRepository::class);
        $theme = $this->fakeConnectionData($connectionFields);
        return $connectionRepo->create($theme);
    }

    /**
     * Get fake instance of Connection
     *
     * @param array $connectionFields
     * @return Connection
     */
    public function fakeConnection($connectionFields = [])
    {
        return new Connection($this->fakeConnectionData($connectionFields));
    }

    /**
     * Get fake data of Connection
     *
     * @param array $connectionFields
     * @return array
     */
    public function fakeConnectionData($connectionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $connectionFields);
    }
}
