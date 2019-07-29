<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeGroupTrait;
use Tests\ApiTestTrait;

class GroupApiTest extends TestCase
{
    use MakeGroupTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_group()
    {
        $group = $this->fakeGroupData();
        $this->response = $this->json('POST', '/api/groups', $group);

        $this->assertApiResponse($group);
    }

    /**
     * @test
     */
    public function test_read_group()
    {
        $group = $this->makeGroup();
        $this->response = $this->json('GET', '/api/groups/'.$group->id);

        $this->assertApiResponse($group->toArray());
    }

    /**
     * @test
     */
    public function test_update_group()
    {
        $group = $this->makeGroup();
        $editedGroup = $this->fakeGroupData();

        $this->response = $this->json('PUT', '/api/groups/'.$group->id, $editedGroup);

        $this->assertApiResponse($editedGroup);
    }

    /**
     * @test
     */
    public function test_delete_group()
    {
        $group = $this->makeGroup();
        $this->response = $this->json('DELETE', '/api/groups/'.$group->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/groups/'.$group->id);

        $this->response->assertStatus(404);
    }
}
