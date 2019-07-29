<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Method;
use App\Repositories\MethodRepository;

trait MakeMethodTrait
{
    /**
     * Create fake instance of Method and save it in database
     *
     * @param array $methodFields
     * @return Method
     */
    public function makeMethod($methodFields = [])
    {
        /** @var MethodRepository $methodRepo */
        $methodRepo = \App::make(MethodRepository::class);
        $theme = $this->fakeMethodData($methodFields);
        return $methodRepo->create($theme);
    }

    /**
     * Get fake instance of Method
     *
     * @param array $methodFields
     * @return Method
     */
    public function fakeMethod($methodFields = [])
    {
        return new Method($this->fakeMethodData($methodFields));
    }

    /**
     * Get fake data of Method
     *
     * @param array $methodFields
     * @return array
     */
    public function fakeMethodData($methodFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $methodFields);
    }
}
