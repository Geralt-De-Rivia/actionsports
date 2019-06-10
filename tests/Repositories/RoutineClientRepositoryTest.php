<?php namespace Tests\Repositories;

use App\Models\RoutineClientModel;
use App\Repositories\RoutineClientRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeRoutineClientTrait;
use Tests\ApiTestTrait;

class RoutineClientRepositoryTest extends TestCase
{
    use MakeRoutineClientTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var RoutineClientRepository
     */
    protected $routineClientRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->routineClientRepo = \App::make(RoutineClientRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_routine_client()
    {
        $routineClient = $this->fakeRoutineClientData();
        $createdRoutineClient = $this->routineClientRepo->create($routineClient);
        $createdRoutineClient = $createdRoutineClient->toArray();
        $this->assertArrayHasKey('id', $createdRoutineClient);
        $this->assertNotNull($createdRoutineClient['id'], 'Created RoutineClient must have id specified');
        $this->assertNotNull(RoutineClientModel::find($createdRoutineClient['id']), 'RoutineClient with given id must be in DB');
        $this->assertModelData($routineClient, $createdRoutineClient);
    }

    /**
     * @test read
     */
    public function test_read_routine_client()
    {
        $routineClient = $this->makeRoutineClient();
        $dbRoutineClient = $this->routineClientRepo->find($routineClient->id);
        $dbRoutineClient = $dbRoutineClient->toArray();
        $this->assertModelData($routineClient->toArray(), $dbRoutineClient);
    }

    /**
     * @test update
     */
    public function test_update_routine_client()
    {
        $routineClient = $this->makeRoutineClient();
        $fakeRoutineClient = $this->fakeRoutineClientData();
        $updatedRoutineClient = $this->routineClientRepo->update($fakeRoutineClient, $routineClient->id);
        $this->assertModelData($fakeRoutineClient, $updatedRoutineClient->toArray());
        $dbRoutineClient = $this->routineClientRepo->find($routineClient->id);
        $this->assertModelData($fakeRoutineClient, $dbRoutineClient->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_routine_client()
    {
        $routineClient = $this->makeRoutineClient();
        $resp = $this->routineClientRepo->delete($routineClient->id);
        $this->assertTrue($resp);
        $this->assertNull(RoutineClientModel::find($routineClient->id), 'RoutineClient should not exist in DB');
    }
}
