<?php namespace Tests\Repositories;

use App\Models\ClassScheduleModel;
use App\Repositories\ClassScheduleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeClassScheduleTrait;
use Tests\ApiTestTrait;

class ClassScheduleRepositoryTest extends TestCase
{
    use MakeClassScheduleTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ClassScheduleRepository
     */
    protected $classScheduleRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->classScheduleRepo = \App::make(ClassScheduleRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_class_schedule()
    {
        $classSchedule = $this->fakeClassScheduleData();
        $createdClassSchedule = $this->classScheduleRepo->create($classSchedule);
        $createdClassSchedule = $createdClassSchedule->toArray();
        $this->assertArrayHasKey('id', $createdClassSchedule);
        $this->assertNotNull($createdClassSchedule['id'], 'Created ClassSchedule must have id specified');
        $this->assertNotNull(ClassScheduleModel::find($createdClassSchedule['id']), 'ClassSchedule with given id must be in DB');
        $this->assertModelData($classSchedule, $createdClassSchedule);
    }

    /**
     * @test read
     */
    public function test_read_class_schedule()
    {
        $classSchedule = $this->makeClassSchedule();
        $dbClassSchedule = $this->classScheduleRepo->find($classSchedule->id);
        $dbClassSchedule = $dbClassSchedule->toArray();
        $this->assertModelData($classSchedule->toArray(), $dbClassSchedule);
    }

    /**
     * @test update
     */
    public function test_update_class_schedule()
    {
        $classSchedule = $this->makeClassSchedule();
        $fakeClassSchedule = $this->fakeClassScheduleData();
        $updatedClassSchedule = $this->classScheduleRepo->update($fakeClassSchedule, $classSchedule->id);
        $this->assertModelData($fakeClassSchedule, $updatedClassSchedule->toArray());
        $dbClassSchedule = $this->classScheduleRepo->find($classSchedule->id);
        $this->assertModelData($fakeClassSchedule, $dbClassSchedule->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_class_schedule()
    {
        $classSchedule = $this->makeClassSchedule();
        $resp = $this->classScheduleRepo->delete($classSchedule->id);
        $this->assertTrue($resp);
        $this->assertNull(ClassScheduleModel::find($classSchedule->id), 'ClassSchedule should not exist in DB');
    }
}
