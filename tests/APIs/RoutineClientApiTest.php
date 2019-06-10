<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeRoutineClientTrait;
use Tests\ApiTestTrait;

class RoutineClientApiTest extends TestCase
{
    use MakeRoutineClientTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_routine_client()
    {
        $routineClient = $this->fakeRoutineClientData();
        $this->response = $this->json('POST', '/api/routineClients', $routineClient);

        $this->assertApiResponse($routineClient);
    }

    /**
     * @test
     */
    public function test_read_routine_client()
    {
        $routineClient = $this->makeRoutineClient();
        $this->response = $this->json('GET', '/api/routineClients/'.$routineClient->id);

        $this->assertApiResponse($routineClient->toArray());
    }

    /**
     * @test
     */
    public function test_update_routine_client()
    {
        $routineClient = $this->makeRoutineClient();
        $editedRoutineClient = $this->fakeRoutineClientData();

        $this->response = $this->json('PUT', '/api/routineClients/'.$routineClient->id, $editedRoutineClient);

        $this->assertApiResponse($editedRoutineClient);
    }

    /**
     * @test
     */
    public function test_delete_routine_client()
    {
        $routineClient = $this->makeRoutineClient();
        $this->response = $this->json('DELETE', '/api/routineClients/'.$routineClient->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/routineClients/'.$routineClient->id);

        $this->response->assertStatus(404);
    }
}
