<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMachineTrait;
use Tests\ApiTestTrait;

class MachineApiTest extends TestCase
{
    use MakeMachineTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_machine()
    {
        $machine = $this->fakeMachineData();
        $this->response = $this->json('POST', '/api/machines', $machine);

        $this->assertApiResponse($machine);
    }

    /**
     * @test
     */
    public function test_read_machine()
    {
        $machine = $this->makeMachine();
        $this->response = $this->json('GET', '/api/machines/'.$machine->id);

        $this->assertApiResponse($machine->toArray());
    }

    /**
     * @test
     */
    public function test_update_machine()
    {
        $machine = $this->makeMachine();
        $editedMachine = $this->fakeMachineData();

        $this->response = $this->json('PUT', '/api/machines/'.$machine->id, $editedMachine);

        $this->assertApiResponse($editedMachine);
    }

    /**
     * @test
     */
    public function test_delete_machine()
    {
        $machine = $this->makeMachine();
        $this->response = $this->json('DELETE', '/api/machines/'.$machine->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/machines/'.$machine->id);

        $this->response->assertStatus(404);
    }
}
