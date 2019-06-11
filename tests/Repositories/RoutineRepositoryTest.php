<?php namespace Tests\Repositories;

use App\Models\RoutineModel;
use App\Repositories\RoutineRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeRoutineTrait;
use Tests\ApiTestTrait;

class RoutineRepositoryTest extends TestCase
{
    use MakeRoutineTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var RoutineRepository
     */
    protected $routineRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->routineRepo = \App::make(RoutineRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_routine()
    {
        $routine = $this->fakeRoutineData();
        $createdRoutine = $this->routineRepo->create($routine);
        $createdRoutine = $createdRoutine->toArray();
        $this->assertArrayHasKey('id', $createdRoutine);
        $this->assertNotNull($createdRoutine['id'], 'Created RoutineModel must have id specified');
        $this->assertNotNull(RoutineModel::find($createdRoutine['id']), 'RoutineModel with given id must be in DB');
        $this->assertModelData($routine, $createdRoutine);
    }

    /**
     * @test read
     */
    public function test_read_routine()
    {
        $routine = $this->makeRoutine();
        $dbRoutine = $this->routineRepo->find($routine->id);
        $dbRoutine = $dbRoutine->toArray();
        $this->assertModelData($routine->toArray(), $dbRoutine);
    }

    /**
     * @test update
     */
    public function test_update_routine()
    {
        $routine = $this->makeRoutine();
        $fakeRoutine = $this->fakeRoutineData();
        $updatedRoutine = $this->routineRepo->update($fakeRoutine, $routine->id);
        $this->assertModelData($fakeRoutine, $updatedRoutine->toArray());
        $dbRoutine = $this->routineRepo->find($routine->id);
        $this->assertModelData($fakeRoutine, $dbRoutine->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_routine()
    {
        $routine = $this->makeRoutine();
        $resp = $this->routineRepo->delete($routine->id);
        $this->assertTrue($resp);
        $this->assertNull(RoutineModel::find($routine->id), 'RoutineModel should not exist in DB');
    }
}
