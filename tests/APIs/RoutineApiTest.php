<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeRoutineTrait;
use Tests\ApiTestTrait;

class RoutineApiTest extends TestCase
{
    use MakeRoutineTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_routine()
    {
        $routine = $this->fakeRoutineData();
        $this->response = $this->json('POST', '/api/routines', $routine);

        $this->assertApiResponse($routine);
    }

    /**
     * @test
     */
    public function test_read_routine()
    {
        $routine = $this->makeRoutine();
        $this->response = $this->json('GET', '/api/routines/'.$routine->id);

        $this->assertApiResponse($routine->toArray());
    }

    /**
     * @test
     */
    public function test_update_routine()
    {
        $routine = $this->makeRoutine();
        $editedRoutine = $this->fakeRoutineData();

        $this->response = $this->json('PUT', '/api/routines/'.$routine->id, $editedRoutine);

        $this->assertApiResponse($editedRoutine);
    }

    /**
     * @test
     */
    public function test_delete_routine()
    {
        $routine = $this->makeRoutine();
        $this->response = $this->json('DELETE', '/api/routines/'.$routine->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/routines/'.$routine->id);

        $this->response->assertStatus(404);
    }
}
