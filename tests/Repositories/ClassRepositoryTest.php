<?php namespace Tests\Repositories;

use App\Models\Class;
use App\Repositories\ClassRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeClassTrait;
use Tests\ApiTestTrait;

class ClassRepositoryTest extends TestCase
{
    use MakeClassTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ClassRepository
     */
    protected $classRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->classRepo = \App::make(ClassRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_class()
    {
        $class = $this->fakeClassData();
        $createdClass = $this->classRepo->create($class);
        $createdClass = $createdClass->toArray();
        $this->assertArrayHasKey('id', $createdClass);
        $this->assertNotNull($createdClass['id'], 'Created Class must have id specified');
        $this->assertNotNull(Class::find($createdClass['id']), 'Class with given id must be in DB');
        $this->assertModelData($class, $createdClass);
    }

    /**
     * @test read
     */
    public function test_read_class()
    {
        $class = $this->makeClass();
        $dbClass = $this->classRepo->find($class->id);
        $dbClass = $dbClass->toArray();
        $this->assertModelData($class->toArray(), $dbClass);
    }

    /**
     * @test update
     */
    public function test_update_class()
    {
        $class = $this->makeClass();
        $fakeClass = $this->fakeClassData();
        $updatedClass = $this->classRepo->update($fakeClass, $class->id);
        $this->assertModelData($fakeClass, $updatedClass->toArray());
        $dbClass = $this->classRepo->find($class->id);
        $this->assertModelData($fakeClass, $dbClass->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_class()
    {
        $class = $this->makeClass();
        $resp = $this->classRepo->delete($class->id);
        $this->assertTrue($resp);
        $this->assertNull(Class::find($class->id), 'Class should not exist in DB');
    }
}
