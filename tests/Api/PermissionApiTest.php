<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePermissionTrait;
use Tests\ApiTestTrait;

class PermissionApiTest extends TestCase
{
    use MakePermissionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_permission()
    {
        $permission = $this->fakePermissionData();
        $this->response = $this->json('POST', '/api/permissions', $permission);

        $this->assertApiResponse($permission);
    }

    /**
     * @test
     */
    public function test_read_permission()
    {
        $permission = $this->makePermission();
        $this->response = $this->json('GET', '/api/permissions/'.$permission->id);

        $this->assertApiResponse($permission->toArray());
    }

    /**
     * @test
     */
    public function test_update_permission()
    {
        $permission = $this->makePermission();
        $editedPermission = $this->fakePermissionData();

        $this->response = $this->json('PUT', '/api/permissions/'.$permission->id, $editedPermission);

        $this->assertApiResponse($editedPermission);
    }

    /**
     * @test
     */
    public function test_delete_permission()
    {
        $permission = $this->makePermission();
        $this->response = $this->json('DELETE', '/api/permissions/'.$permission->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/permissions/'.$permission->id);

        $this->response->assertStatus(404);
    }
}
