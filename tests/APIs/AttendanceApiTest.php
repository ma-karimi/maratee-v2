<?php namespace Tests\Apis;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeAttendanceTrait;
use Tests\ApiTestTrait;

class AttendanceApiTest extends TestCase
{
    use MakeAttendanceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_attendance()
    {
        $attendance = $this->fakeAttendanceData();
        $this->response = $this->json('POST', '/api/attendances', $attendance);

        $this->assertApiResponse($attendance);
    }

    /**
     * @test
     */
    public function test_read_attendance()
    {
        $attendance = $this->makeAttendance();
        $this->response = $this->json('GET', '/api/attendances/'.$attendance->id);

        $this->assertApiResponse($attendance->toArray());
    }

    /**
     * @test
     */
    public function test_update_attendance()
    {
        $attendance = $this->makeAttendance();
        $editedAttendance = $this->fakeAttendanceData();

        $this->response = $this->json('PUT', '/api/attendances/'.$attendance->id, $editedAttendance);

        $this->assertApiResponse($editedAttendance);
    }

    /**
     * @test
     */
    public function test_delete_attendance()
    {
        $attendance = $this->makeAttendance();
        $this->response = $this->json('DELETE', '/api/attendances/'.$attendance->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/attendances/'.$attendance->id);

        $this->response->assertStatus(404);
    }
}
