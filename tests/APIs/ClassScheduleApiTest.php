<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeClassScheduleTrait;
use Tests\ApiTestTrait;

class ClassScheduleApiTest extends TestCase
{
    use MakeClassScheduleTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_class_schedule()
    {
        $classSchedule = $this->fakeClassScheduleData();
        $this->response = $this->json('POST', '/api/classSchedules', $classSchedule);

        $this->assertApiResponse($classSchedule);
    }

    /**
     * @test
     */
    public function test_read_class_schedule()
    {
        $classSchedule = $this->makeClassSchedule();
        $this->response = $this->json('GET', '/api/classSchedules/'.$classSchedule->id);

        $this->assertApiResponse($classSchedule->toArray());
    }

    /**
     * @test
     */
    public function test_update_class_schedule()
    {
        $classSchedule = $this->makeClassSchedule();
        $editedClassSchedule = $this->fakeClassScheduleData();

        $this->response = $this->json('PUT', '/api/classSchedules/'.$classSchedule->id, $editedClassSchedule);

        $this->assertApiResponse($editedClassSchedule);
    }

    /**
     * @test
     */
    public function test_delete_class_schedule()
    {
        $classSchedule = $this->makeClassSchedule();
        $this->response = $this->json('DELETE', '/api/classSchedules/'.$classSchedule->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/classSchedules/'.$classSchedule->id);

        $this->response->assertStatus(404);
    }
}
