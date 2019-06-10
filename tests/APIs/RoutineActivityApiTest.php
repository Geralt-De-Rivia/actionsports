<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeRoutineActivityTrait;
use Tests\ApiTestTrait;

class RoutineActivityApiTest extends TestCase
{
    use MakeRoutineActivityTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_routine_activity()
    {
        $routineActivity = $this->fakeRoutineActivityData();
        $this->response = $this->json('POST', '/api/routineActivities', $routineActivity);

        $this->assertApiResponse($routineActivity);
    }

    /**
     * @test
     */
    public function test_read_routine_activity()
    {
        $routineActivity = $this->makeRoutineActivity();
        $this->response = $this->json('GET', '/api/routineActivities/'.$routineActivity->id);

        $this->assertApiResponse($routineActivity->toArray());
    }

    /**
     * @test
     */
    public function test_update_routine_activity()
    {
        $routineActivity = $this->makeRoutineActivity();
        $editedRoutineActivity = $this->fakeRoutineActivityData();

        $this->response = $this->json('PUT', '/api/routineActivities/'.$routineActivity->id, $editedRoutineActivity);

        $this->assertApiResponse($editedRoutineActivity);
    }

    /**
     * @test
     */
    public function test_delete_routine_activity()
    {
        $routineActivity = $this->makeRoutineActivity();
        $this->response = $this->json('DELETE', '/api/routineActivities/'.$routineActivity->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/routineActivities/'.$routineActivity->id);

        $this->response->assertStatus(404);
    }
}
