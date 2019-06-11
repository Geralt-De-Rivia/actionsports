<?php namespace Tests\Repositories;

use App\Models\ClassReservationModel;
use App\Repositories\ClassReservationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeClassReservationTrait;
use Tests\ApiTestTrait;

class ClassReservationRepositoryTest extends TestCase
{
    use MakeClassReservationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ClassReservationRepository
     */
    protected $classReservationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->classReservationRepo = \App::make(ClassReservationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_class_reservation()
    {
        $classReservation = $this->fakeClassReservationData();
        $createdClassReservation = $this->classReservationRepo->create($classReservation);
        $createdClassReservation = $createdClassReservation->toArray();
        $this->assertArrayHasKey('id', $createdClassReservation);
        $this->assertNotNull($createdClassReservation['id'], 'Created ClassReservation must have id specified');
        $this->assertNotNull(ClassReservationModel::find($createdClassReservation['id']), 'ClassReservation with given id must be in DB');
        $this->assertModelData($classReservation, $createdClassReservation);
    }

    /**
     * @test read
     */
    public function test_read_class_reservation()
    {
        $classReservation = $this->makeClassReservation();
        $dbClassReservation = $this->classReservationRepo->find($classReservation->id);
        $dbClassReservation = $dbClassReservation->toArray();
        $this->assertModelData($classReservation->toArray(), $dbClassReservation);
    }

    /**
     * @test update
     */
    public function test_update_class_reservation()
    {
        $classReservation = $this->makeClassReservation();
        $fakeClassReservation = $this->fakeClassReservationData();
        $updatedClassReservation = $this->classReservationRepo->update($fakeClassReservation, $classReservation->id);
        $this->assertModelData($fakeClassReservation, $updatedClassReservation->toArray());
        $dbClassReservation = $this->classReservationRepo->find($classReservation->id);
        $this->assertModelData($fakeClassReservation, $dbClassReservation->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_class_reservation()
    {
        $classReservation = $this->makeClassReservation();
        $resp = $this->classReservationRepo->delete($classReservation->id);
        $this->assertTrue($resp);
        $this->assertNull(ClassReservationModel::find($classReservation->id), 'ClassReservation should not exist in DB');
    }
}
