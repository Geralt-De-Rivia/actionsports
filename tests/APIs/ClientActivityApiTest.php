<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeClientActivityTrait;
use Tests\ApiTestTrait;

class ClientActivityApiTest extends TestCase
{
    use MakeClientActivityTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_client_activity()
    {
        $clientActivity = $this->fakeClientActivityData();
        $this->response = $this->json('POST', '/api/clientActivities', $clientActivity);

        $this->assertApiResponse($clientActivity);
    }

    /**
     * @test
     */
    public function test_read_client_activity()
    {
        $clientActivity = $this->makeClientActivity();
        $this->response = $this->json('GET', '/api/clientActivities/'.$clientActivity->id);

        $this->assertApiResponse($clientActivity->toArray());
    }

    /**
     * @test
     */
    public function test_update_client_activity()
    {
        $clientActivity = $this->makeClientActivity();
        $editedClientActivity = $this->fakeClientActivityData();

        $this->response = $this->json('PUT', '/api/clientActivities/'.$clientActivity->id, $editedClientActivity);

        $this->assertApiResponse($editedClientActivity);
    }

    /**
     * @test
     */
    public function test_delete_client_activity()
    {
        $clientActivity = $this->makeClientActivity();
        $this->response = $this->json('DELETE', '/api/clientActivities/'.$clientActivity->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/clientActivities/'.$clientActivity->id);

        $this->response->assertStatus(404);
    }
}
