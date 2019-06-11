<?php namespace Tests\Repositories;

use App\Models\ClassTypeModel;
use App\Repositories\ClassTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeClassTypeTrait;
use Tests\ApiTestTrait;

class ClassTypeRepositoryTest extends TestCase
{
    use MakeClassTypeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ClassTypeRepository
     */
    protected $classTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->classTypeRepo = \App::make(ClassTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_class_type()
    {
        $classType = $this->fakeClassTypeData();
        $createdClassType = $this->classTypeRepo->create($classType);
        $createdClassType = $createdClassType->toArray();
        $this->assertArrayHasKey('id', $createdClassType);
        $this->assertNotNull($createdClassType['id'], 'Created ClassType must have id specified');
        $this->assertNotNull(ClassTypeModel::find($createdClassType['id']), 'ClassType with given id must be in DB');
        $this->assertModelData($classType, $createdClassType);
    }

    /**
     * @test read
     */
    public function test_read_class_type()
    {
        $classType = $this->makeClassType();
        $dbClassType = $this->classTypeRepo->find($classType->id);
        $dbClassType = $dbClassType->toArray();
        $this->assertModelData($classType->toArray(), $dbClassType);
    }

    /**
     * @test update
     */
    public function test_update_class_type()
    {
        $classType = $this->makeClassType();
        $fakeClassType = $this->fakeClassTypeData();
        $updatedClassType = $this->classTypeRepo->update($fakeClassType, $classType->id);
        $this->assertModelData($fakeClassType, $updatedClassType->toArray());
        $dbClassType = $this->classTypeRepo->find($classType->id);
        $this->assertModelData($fakeClassType, $dbClassType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_class_type()
    {
        $classType = $this->makeClassType();
        $resp = $this->classTypeRepo->delete($classType->id);
        $this->assertTrue($resp);
        $this->assertNull(ClassTypeModel::find($classType->id), 'ClassType should not exist in DB');
    }
}
