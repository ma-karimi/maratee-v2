<?php namespace Tests\Api;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeDepartmentTrait;
use Tests\ApiTestTrait;

class DepartmentApiTest extends TestCase
{
    use MakeDepartmentTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_department()
    {
        $department = $this->fakeDepartmentData();
        $this->response = $this->json('POST', '/api/departments', $department);

        $this->assertApiResponse($department);
    }

    /**
     * @test
     */
    public function test_read_department()
    {
        $department = $this->makeDepartment();
        $this->response = $this->json('GET', '/api/departments/'.$department->id);

        $this->assertApiResponse($department->toArray());
    }

    /**
     * @test
     */
    public function test_update_department()
    {
        $department = $this->makeDepartment();
        $editedDepartment = $this->fakeDepartmentData();

        $this->response = $this->json('PUT', '/api/departments/'.$department->id, $editedDepartment);

        $this->assertApiResponse($editedDepartment);
    }

    /**
     * @test
     */
    public function test_delete_department()
    {
        $department = $this->makeDepartment();
        $this->response = $this->json('DELETE', '/api/departments/'.$department->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/departments/'.$department->id);

        $this->response->assertStatus(404);
    }
}
