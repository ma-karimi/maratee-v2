<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Geramin;
use App\Repositories\GeraminRepository;

trait MakeGeraminTrait
{
    /**
     * Create fake instance of Geramin and save it in database
     *
     * @param array $geraminFields
     * @return Geramin
     */
    public function makeGeramin($geraminFields = [])
    {
        /** @var GeraminRepository $geraminRepo */
        $geraminRepo = \App::make(GeraminRepository::class);
        $theme = $this->fakeGeraminData($geraminFields);
        return $geraminRepo->create($theme);
    }

    /**
     * Get fake instance of Geramin
     *
     * @param array $geraminFields
     * @return Geramin
     */
    public function fakeGeramin($geraminFields = [])
    {
        return new Geramin($this->fakeGeraminData($geraminFields));
    }

    /**
     * Get fake data of Geramin
     *
     * @param array $geraminFields
     * @return array
     */
    public function fakeGeraminData($geraminFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $geraminFields);
    }
}
