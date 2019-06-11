<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeActivityTrait;
use Tests\ApiTestTrait;

class ActivityApiTest extends TestCase
{
    use MakeActivityTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_activity()
    {
        $activity = $this->fakeActivityData();
        $this->response = $this->json('POST', '/api/activities', $activity);

        $this->assertApiResponse($activity);
    }

    /**
     * @test
     */
    public function test_read_activity()
    {
        $activity = $this->makeActivity();
        $this->response = $this->json('GET', '/api/activities/'.$activity->id);

        $this->assertApiResponse($activity->toArray());
    }

    /**
     * @test
     */
    public function test_update_activity()
    {
        $activity = $this->makeActivity();
        $editedActivity = $this->fakeActivityData();

        $this->response = $this->json('PUT', '/api/activities/'.$activity->id, $editedActivity);

        $this->assertApiResponse($editedActivity);
    }

    /**
     * @test
     */
    public function test_delete_activity()
    {
        $activity = $this->makeActivity();
        $this->response = $this->json('DELETE', '/api/activities/'.$activity->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/activities/'.$activity->id);

        $this->response->assertStatus(404);
    }
}
