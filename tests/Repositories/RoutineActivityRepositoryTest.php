<?php namespace Tests\Repositories;

use App\Models\RoutineActivityModel;
use App\Repositories\RoutineActivityRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeRoutineActivityTrait;
use Tests\ApiTestTrait;

class RoutineActivityRepositoryTest extends TestCase
{
    use MakeRoutineActivityTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var RoutineActivityRepository
     */
    protected $routineActivityRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->routineActivityRepo = \App::make(RoutineActivityRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_routine_activity()
    {
        $routineActivity = $this->fakeRoutineActivityData();
        $createdRoutineActivity = $this->routineActivityRepo->create($routineActivity);
        $createdRoutineActivity = $createdRoutineActivity->toArray();
        $this->assertArrayHasKey('id', $createdRoutineActivity);
        $this->assertNotNull($createdRoutineActivity['id'], 'Created RoutineActivity must have id specified');
        $this->assertNotNull(RoutineActivityModel::find($createdRoutineActivity['id']), 'RoutineActivity with given id must be in DB');
        $this->assertModelData($routineActivity, $createdRoutineActivity);
    }

    /**
     * @test read
     */
    public function test_read_routine_activity()
    {
        $routineActivity = $this->makeRoutineActivity();
        $dbRoutineActivity = $this->routineActivityRepo->find($routineActivity->id);
        $dbRoutineActivity = $dbRoutineActivity->toArray();
        $this->assertModelData($routineActivity->toArray(), $dbRoutineActivity);
    }

    /**
     * @test update
     */
    public function test_update_routine_activity()
    {
        $routineActivity = $this->makeRoutineActivity();
        $fakeRoutineActivity = $this->fakeRoutineActivityData();
        $updatedRoutineActivity = $this->routineActivityRepo->update($fakeRoutineActivity, $routineActivity->id);
        $this->assertModelData($fakeRoutineActivity, $updatedRoutineActivity->toArray());
        $dbRoutineActivity = $this->routineActivityRepo->find($routineActivity->id);
        $this->assertModelData($fakeRoutineActivity, $dbRoutineActivity->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_routine_activity()
    {
        $routineActivity = $this->makeRoutineActivity();
        $resp = $this->routineActivityRepo->delete($routineActivity->id);
        $this->assertTrue($resp);
        $this->assertNull(RoutineActivityModel::find($routineActivity->id), 'RoutineActivity should not exist in DB');
    }
}
